/**
 * Created by dungang on 2017/5/27.
 */
+function ($) {
    var defaults = {
        url: document.URL,
        method: 'POST',
        extraData:{},
        maxFileSize: 0,
        allowedTypes: '*',
        extFilter: null,
        dataType: 'json',
        fileName: 'file',
        checkImageSize:false,
        imageSize:{
            height:100,
            width:100
        },
        messages:{
            fileTypeError:'只允许上传{{types}}的文件, 当前文件的类型是{{ctype}} ',
            fileSizeError:'上传文件的大小不能超过{{size}},当前文件的大小为{{csize}}',
            imageSizeError:'图片的高不能超过{{height}},宽不能超过{{width}},当前文件的高：{{cheight}},宽：{{cwidth}}'
        },
        onInit:function(){},
        onFallbackMode: function(message) {},
        onBeforeUpload: function () {},
        onPreview: function () {},
        onComplete:function(){},
        onUploadProgress:function(){},
        onUploadSuccess:function(){},
        onUploadError:function(){},
        onFileTypeError:function(){},
        onFileSizeError:function(){},
        onImageSizeError:function(){},
        onFileExtError:function(){}
    };

    var SimpleUploader = function(element,options) {
        this.element = $(element);
        this.file = null;
        this.input = null;
        this.settings = $.extend({},defaults,options);
        if (this.checkBrowser()) {
            this.init();
        }
    };

    SimpleUploader.prototype.init = function() {
        var _this = this;
        this.input = this.element.find('input[type=file]');
        if (this.input.length == 0 ) {
            this.input = $('<input type="file"/>');
            this.input.appendTo(this.element);
        }
        this.input.attr('multiple',false).hide()
        .on('change',function(event){
            if (event.target.files.length > 0) {
                _this.file = event.target.files[0];
                _this.checkFile();
                _this.readImageFile();
                $(this).val('');
            }
        });
        this.element.on('click',function (event) {
            event.stopPropagation();
            _this.input.trigger(event);
        });
        this.settings.onInit.call(this.element);
    };



    SimpleUploader.prototype.checkBrowser = function() {
        if(window.FormData === undefined || window.FileReader === undefined) {
            this.settings.onFallbackMode.call(this.element,'Browser doesn\'t support Form API');
            return false;
        }
        return true;
    };

    SimpleUploader.prototype.humanFileSize = function (bytes, si) {
        var thresh = si ? 1000 : 1024;
        if(Math.abs(bytes) < thresh) {
            return bytes + ' B';
        }
        var units = si
            ? ['kB','MB','GB','TB','PB','EB','ZB','YB']
            : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
        var u = -1;
        do {
            bytes /= thresh;
            ++u;
        } while(Math.abs(bytes) >= thresh && u < units.length - 1);
        return bytes.toFixed(1)+' '+units[u];
    };

    SimpleUploader.prototype.checkFile = function() {
        if(this.settings.maxFileSize > 0 && this.file.size > this.settings.maxFileSize) {
            alert(this.settings.messages.fileSizeError
                .replace('{{size}}',this.humanFileSize(this.settings.maxFileSize,false))
                .replace('{{csize}}',this.humanFileSize(this.file.size,false))
            );
            this.settings.onFileSizeError.call(this.element,this.file);
            return false;
        }

        var allowedTypes = this.settings.allowedTypes;
        if (allowedTypes != "*" ) {
            var allowed = false;
            if(typeof allowedTypes == 'string' && this.file.type.match(allowedTypes)) {
                allowed = true;
            } else if ((typeof allowedTypes == 'object') && allowedTypes.constructor == Array) {
                for(var t in allowedTypes) {
                    if(allowedTypes.hasOwnProperty(t)  && this.file.type.match(allowedTypes[t])) {
                        allowed = true;
                        break;
                    }
                }
            }
            if(!allowed) {
                var types = '';
                if((typeof allowedTypes == 'object') && allowedTypes.constructor == Array ) {
                    types = allowedTypes.join(',');
                } else {
                    types = allowedTypes;
                }
                alert(this.settings.messages.fileTypeError
                    .replace('{{types}}',types)
                    .replace('{{ctype}}',this.file.type)
                );
                this.settings.onFileTypeError.call(this.element,this.file);
                return false;
            }
        }

        if (this.settings.extFilter != null) {
            var extList = this.settings.extFilter.toLowerCase().split(';');
            var ext = file.name.toLowerCase().split('.').pop();
            if($.inArray(ext, extList) < 0) {
                this.settings.onFileExtError.call(this.element, this.file);
                return false;
            }
        }

        return true;
    };


    SimpleUploader.prototype.isImage = function () {
        return this.file.type.match('image/*');
    };


    SimpleUploader.prototype.readImageFile =  function () {
        var _this = this;
        if(this.isImage()) {
            var reader = new FileReader();
            reader.addEventListener('load', function () {
                //check image file height,width
                if (_this.settings.checkImageSize) {
                    var img = new Image();
                    img.src =this.result;
                    img.addEventListener('load',function () {
                        if(img.height > _this.settings.imageSize.height || img.width > _this.settings.imageSize.width) {
                            alert(_this.settings.messages.imageSizeError
                                .replace('{{height}}',_this.settings.imageSize.height)
                                .replace('{{width}}',_this.settings.imageSize.width)
                                .replace('{{cheight}}',img.height)
                                .replace('{{cwidth}}',img.width)
                            );
                            _this.settings.onImageSizeError.call(_this.file,_this.settings.imageSize,{
                                height:img.height,
                                width:img.width
                            });
                            return false;
                        }

                        //call preview
                        _this.settings.onPreview.call(_this.element,img.src);
                        _this.process();
                    });

                } else {
                    //call preview
                    _this.settings.onPreview.call(_this.element,this.result);
                    _this.process();
                }
            });
            reader.readAsDataURL(this.file);
        } else {
            this.process();
        }
    };

    SimpleUploader.prototype.process = function () {
        var _this = this;
        var form = new FormData();
        form.append(this.settings.fileName,this.file);
        var can_process = this.settings.onBeforeUpload.call(this.element,this.file);
        if (can_process!==false) {
            $.each(this.settings.extraData, function(exKey, exVal){
                form.append(exKey, exVal);
            });
            $.ajax({
                url:this.settings.url,
                type:this.settings.method,
                dataType:this.settings.dataType,
                data:form,
                cache:false,
                contentType:false,
                processData:false,
                forceSync:false,
                xhr: function(){
                    var xhrObj = $.ajaxSettings.xhr();
                    if(xhrObj.upload){
                        xhrObj.upload.addEventListener('progress', function(event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total || event.totalSize;
                            if(event.lengthComputable){
                                percent = Math.ceil(position / total * 100);
                            }
                            _this.settings.onUploadProgress.call(_this.element, percent);
                        }, false);
                    }

                    return xhrObj;
                },
                success: function (data, message, xhr){
                    _this.settings.onUploadSuccess.call(_this.element, data, message,xhr);
                },
                error: function (xhr, status, errMsg){
                    _this.settings.onUploadError.call(_this.element,  errMsg);
                },
                complete: function(xhr, textStatus){
                    _this.settings.onComplete.call(_this.element,  xhr, textStatus);
                }
            });
        }
    };

    $.fn.simpleUploader = function (options) {
        return this.each(function(){
            var _this = $(this);
            if (!$.data(this,'simpleUploader')) {
                var zone = _this.parent().find('.simple-uploader-zone');
                if (zone.length > 0 ) {
                    $.data(this,'simpleUploader',new SimpleUploader(zone[0],options));
                }
            }
        });
    }

}(jQuery);