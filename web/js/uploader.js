/**
 * Created by Lenovo on 2017/5/27. 多个文件一个接着一个顺序上传
 */
+function($) {

	var FileInfo = function() {

		this.name = null;
		this.size = null;
		this.type = null;
		this.uploadId = null;
		this.key = null;
		this.stream = null;
		this.lastModified = null;
		this.error = null;
	};

	var Uploader = function(element, options) {
		this.element = $(element);
		this.files = []; // 文件列表
		this.processFile = null;
		this.xhr = null // 当前ajax xhr对象
		this.input = null;
		this.options = options;
		this.mloader = $('body');
		this.hasError = false;
		if (this.checkBrowser()) {
			this.init();
		}
	};
	Uploader.DEFAULTS = {
		multiple : true, //
		url : document.URL, // 上传文件的地址
		method : 'POST', // 上传文件的方法
		extradata : {}, // 额外的参数
		maxfilesize : 1024 * 1024 * 4, // 文件允许的最大空间
		allowedtypes : '*', // 允许上传的文件类型 image/*
		extfilter : null, // 文件后缀过滤
		datatype : null, // ajax返回的数据类型
		filename : 'file', // 文件的表单名称
		checkimagesize : false, // 是否检查文件的尺寸的限制
		chunked : false,
		chunkSize : 1024 * 1024,
		imagesize : {
			height : 100,
			width : 100
		},
		messages : {
			errorfiletype : '只允许上传{{types}}的文件, 当前文件的类型是{{ctype}} ',
			errorfilesize : '上传文件的大小不能超过{{size}},当前文件的大小为{{csize}}',
			erroimagesize : '图片的高不能超过{{height}},宽不能超过{{width}},当前文件的高：{{cheight}},宽：{{cwidth}}'
		},
		onInit : function() {
		}, // 初始化
		onFallbackMode : function(message) {
		}, // 浏览器不支持的时候提示的消息
		onBeforeUpload : function() {
		}, // 上传图片之前
		onBeforeFileUpload : function(file, deferred) {
			deferred.resolve()
		},
		onPreview : function(src) {
		}, // 预览
		onCompletedAll : function() {
		}, // 所有的上传结束，不管成功失败最后调用一次
		onUploadProgress : function(percent) {
		}, // 每次上传文件的进度
		onUploadSuccess : function(data, fileIndex, message, xhr) {
		}, // 每次文件上传成功
		onUploadError : function(errMsg) {
		}, // 每次文件上传失败
		onFileTypeError : function(file) {
		}, // 选择文件的时候，提示文件的类型不对
		onFileSizeError : function(file) {
		}, // 选择文件的时候，提示文件的大小（100Kb）不对
		onImageSizeError : function(optSize, imageSize) {
		}, // 选择文件的时候，提示文件的尺寸（100x60）不对
		onFileExtError : function(file) {
		} // 文件后缀不对
	};

	Uploader.prototype.init = function() {
		var _this = this;
		this.element.css({
			cursor : 'pointer'
		});
		this.input = this.element.find('input[type=file]');
		if (this.input.length == 0) {
			this.input = $('<input type="file"/>');
			this.input.appendTo(this.element);
		}
		this.input.attr('multiple', this.options.multiple).hide().on(
				'change',
				function(event) {
					if (event.target.files.length > 0) {
						var fileStreams = event.target.files;
						if (typeof _this.options.onBeforeUpload == 'function') {
							_this.mloader.mLoading('show');
							_this.mloader.mLoading('update', '已上传第0张/共'
									+ fileStreams.length + "张");
							_this.options.onBeforeUpload.call(_this);
						}
						for (var i = 0; i < fileStreams.length; i++) {
							var stream = fileStreams[i];
							console.log(stream);

							if (_this.checkFile(stream) == false) {
								_this.mloader.mLoading('hide');
								return false;
							}
							var file = new FileInfo();
							file.name = stream.name;
							file.type = stream.type;
							file.size = stream.size;
							file.lastModified = stream.lastModified;
							file.stream = stream;
							_this.files.push(file);
						}
						_this.process(_this.files[0], 0);
					}
				});
		this.element.on('click', function(event) {
			event.stopPropagation();
			_this.input.trigger(event);
		});
		this.options.onInit.call(this);
	};

	Uploader.prototype.process = function(file, fileIndex) {
		var _this = this;
		var deferred = new $.Deferred();
		this.options.onBeforeFileUpload.call(this, file, deferred);
		deferred.always(function() {
			if (_this.isImage(file)) {
				_this.processImageFile(file, fileIndex);
			} else {
				_this.processNormalFile(file, fileIndex);
			}
		});
	}

	Uploader.prototype.checkBrowser = function() {
		if (window.FormData === undefined || window.FileReader === undefined) {
			this.options.onFallbackMode.call(this,
					'Browser doesn\'t support Form API');
			return false;
		}
		return true;
	};

	Uploader.prototype.humanFileSize = function(bytes, si) {
		var thresh = si ? 1000 : 1024;
		if (Math.abs(bytes) < thresh) {
			return bytes + ' B';
		}
		var units = si ? [ 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB' ] : [
				'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB' ];
		var u = -1;
		do {
			bytes /= thresh;
			++u;
		} while (Math.abs(bytes) >= thresh && u < units.length - 1);
		return bytes.toFixed(1) + ' ' + units[u];
	};

	Uploader.prototype.checkFile = function(file) {
		if (this.options.maxfilesize > 0
				&& file.size > this.options.maxfilesize) {
			alert(
					this.options.messages.errorfilesize
							.replace(
									'{{size}}',
									this.humanFileSize(
											this.options.maxfilesize, false))
							.replace('{{csize}}',
									this.humanFileSize(file.size, false)),
					'danger');
			this.options.onFileSizeError.call(this, file);
			return false;
		}

		var allowedtypes = this.options.allowedtypes;
		if (allowedtypes != "*") {
			var allowed = false;
			if (typeof allowedtypes == 'string'
					&& file.type.match(allowedtypes)) {
				allowed = true;
			} else if ((typeof allowedtypes == 'object')
					&& allowedtypes.constructor == Array) {
				for ( var t in allowedtypes) {
					if (allowedtypes.hasOwnProperty(t)
							&& file.type.match(allowedtypes[t])) {
						allowed = true;
						break;
					}
				}
			}
			if (!allowed) {
				var types = '';
				if ((typeof allowedtypes == 'object')
						&& allowedtypes.constructor == Array) {
					types = allowedtypes.join(',');
				} else {
					types = allowedtypes;
				}
				alert(this.options.messages.errorfiletype.replace('{{types}}',
						types).replace('{{ctype}}', file.type), 'danger');
				this.options.onFileTypeError.call(this, file);

				return false;
			}
		}

		if (this.options.extfilter != null) {
			var extList = this.options.extfilter.toLowerCase().split(';');
			var ext = file.name.toLowerCase().split('.').pop();
			if ($.inArray(ext, extList) < 0) {
				this.options.onFileExtError.call(this, file);
				return false;
			}
		}

		return true;
	};

	Uploader.prototype.isImage = function(file) {
		return file.type.match('image/*');
	};

	Uploader.prototype.processImageFile = function(file, fileIndex) {
		var _this = this;
		var reader = new FileReader();
		console.log('load image !')
		var deferred = new $.Deferred();
		deferred.done(function() {
			console.log('check image always')
			_this.options.onPreview.call(_this, this.result);
			_this.processNormalFile(file, fileIndex);
		});
		reader.readAsDataURL(file.stream);
		reader.addEventListener('load', function() {
			// check image file height,width
			console.log('check image size.');
			if (_this.options.checkimagesize) {
				var img = new Image();
				img.src = this.result;
				img.addEventListener('load', function() {
					if (img.height > _this.options.imagesize.height
							|| img.width > _this.options.imagesize.width) {
						alert(_this.options.messages.erroimagesize.replace(
								'{{height}}', _this.options.imagesize.height)
								.replace('{{width}}',
										_this.options.imagesize.width).replace(
										'{{cheight}}', img.height).replace(
										'{{cwidth}}', img.width), 'danger');
						_this.options.onImageSizeError.call(file,
								_this.options.imagesize, {
									height : img.height,
									width : img.width
								});
						_this.mloader.mLoading('hide');
						deferred.reject();
						return false;
					} else {
						deferred.resolve();
					}
				});
			} else {
				deferred.resolve();
			}
		});

	};

	Uploader.prototype.upload = function(forms, index, fileIndex) {
		var _this = this;
		var formData = forms[index];
		var xhr = $.ajax({
			url : _this.options.url,
			type : _this.options.method,
			datatype : _this.options.datatype,
			data : formData,
			cache : false,
			contentType : false,
			processData : false,
			forceSync : false,
			xhr : function() {
				var xhrObj = $.ajaxSettings.xhr();
				if (xhrObj.upload) {
					xhrObj.upload.addEventListener('progress', function(event) {
						var percent = 0;
						var position = event.loaded || event.position;
						var total = event.total || event.totalSize;
						if (event.lengthComputable) {
							percent = Math.ceil(position / total * 100);
						}
						_this.options.onUploadProgress.call(_this, percent);
					}, false);
				}

				return xhrObj;
			}
		}).fail(function(xhr, status, errMsg) {
			_this.options.onUploadError.call(_this, fileIndex, errMsg);
			_this.files[fileIndex].error = xhr.responseJSON;
		}).always(
				function(data, message, xhr) {
					if (index < forms.length - 1) {
						_this.upload(forms, index + 1, fileIndex);
					} else {
						_this.options.onUploadSuccess.call(_this, data,
								fileIndex, message, xhr);
						_this.mloader.mLoading('update', '已上传文件 '
								+ (fileIndex + 1) + '个/共' + _this.files.length
								+ "个");
						if (fileIndex + 1 < _this.files.length) {
							return _this.process(_this.files[fileIndex + 1],
									fileIndex + 1);
						} else {
							_this.options.onCompletedAll.call(_this);
							_this.input.val('');
							_this.mloader.mLoading('hide');
							_this.files = [];
						}
					}

				});
	}

	Uploader.prototype.processNormalFile = function(file, fileIndex) {
		var _this = this;
		this.processFile = file;

		var forms = [];
		var chunks = Math.ceil(file.size / _this.options.chunkSize);
		if (_this.options.chunked == true && chunks > 1) {
			for (var chunk = 0; chunk < chunks; chunk++) {
				var start = chunk * _this.options.chunkSize;
				var end = (chunk + 1) * _this.options.chunkSize;
				var form = new FormData();
				form.append('name', file.name);
				form.append('type', file.type);
				form.append('size', file.size);
				form.append('lastModified', file.lastModified);
				form.append('uploadId', file.uploadId);
				form.append('key', file.key);
				$.each(this.options.extradata, function(exKey, exVal) {
					form.append(exKey, exVal);
				});
				form.append('chunks', chunks);
				form.append('chunk', chunk);
				var blob = new File([ file.stream.slice(start, end) ],
						file.name, {
							type : file.type,
							lastModified : file.lastModified
						});
				form.append(_this.options.filename, blob);
				form.append('chunkSize', blob.size);
				forms.push(form);

			}
		} else {
			var form = new FormData();
			form.append('name', file.name);
			form.append('type', file.type);
			form.append('size', file.size);
			form.append('lastModified', file.lastModified);
			form.append('uploadId', file.uploadId);
			form.append('key', file.key);
			form.append(this.options.filename, file.stream);
			forms.push(form);
		}

		this.upload(forms, 0, fileIndex);

	};

	/**
	 * 执行上传图片
	 * 
	 * @param {object}
	 *            options
	 */
	Uploader.prototype.exec = function(options) {
		this.options = $.extend(true, {}, this.options, options);
		this.element.trigger('click');
	}

	function Plugin(option) {
		var args = Array.prototype.slice.call(arguments, 1);
		return this.each(function() {
			var $this = $(this);
			var data = $this.data('ajax.uploader');
			var options = $.extend(true, {}, Uploader.DEFAULTS, $this.data(),
					typeof option == 'object' && option);
			if (!data) {
				$this.data('ajax.uploader',
						(data = new Uploader(this, options)));
			}
			if (data && typeof option == 'string')
				data[option].apply(data, args);
		});
	}

	var old = $.fn.uploader;
	$.fn.uploader = Plugin;
	$.fn.uploader.Constructor = Uploader;
	$.fn.uploader.noConflict = function() {
		$.fn.uploader = old;
		return this;
	}
}(jQuery);