 var fileAppDirectives = angular.module('myApp', []);

            fileAppDirectives.directive('dropzone', function() {
                return {
                    restrict: 'C',
                    link: function(scope, element, attrs) {

                        var config = {
                            url: '/inform/upload',
                            maxFilesize: 10,
                            paramName: "file",
                            maxThumbnailFilesize: 10,
                            parallelUploads: 1,
                            autoProcessQueue: false
                        };

                        var eventHandlers = {
                            'addedfile': function(file) {
                                scope.file = file;
                                if (this.files[1]!=null) {
                                    this.removeFile(this.files[0]);
                                }
                                scope.$apply(function() {
                                    scope.fileAdded = true;
                                    scope.added();
                                });
                            },

                            'success': function (file, response) {
                              
                            }
                        };

                        dropzone = new Dropzone(element[0], config);

                        angular.forEach(eventHandlers, function(handler, event) {
                            dropzone.on(event, handler);
                        });

                        scope.processDropzone = function() {
                            dropzone.processQueue();
                        };

                        scope.resetDropzone = function() {
                            dropzone.removeAllFiles();
                        }
                    }
                }
            });