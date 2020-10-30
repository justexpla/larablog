@extends('layouts.app')

@section('head')
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="/js/trix.js"></script>

    <script>
        (function() {
            var HOST = "/post/commentary/storeImage"

            addEventListener("trix-attachment-add", function(event) {
                if (event.attachment.file) {
                    uploadFileAttachment(event.attachment)
                }
            })

            function uploadFileAttachment(attachment) {
                uploadFile(attachment.file, setProgress, setAttributes)

                function setProgress(progress) {
                    attachment.setUploadProgress(progress)
                }

                function setAttributes(attributes) {
                    attachment.setAttributes(attributes)
                }
            }

            function uploadFile(file, progressCallback, successCallback) {
                var key = createStorageKey(file)
                var formData = createFormData(key, file)
                var xhr = new XMLHttpRequest()

                xhr.open("POST", HOST, true)

                xhr.upload.addEventListener("progress", function(event) {
                    var progress = event.loaded / event.total * 100
                    progressCallback(progress)
                })

                xhr.addEventListener("load", function(event) {
                    if (xhr.status == 204) {
                        var attributes = {
                            url: '/storage/' + key,
                            href: '/storage/' + key + "?content-disposition=attachment"
                        }
                        successCallback(attributes)
                    }
                })

                xhr.send(formData)
            }

            function createStorageKey(file) {
                var date = new Date()
                var name = date.getTime() + "-" + file.name
                return [ name ].join("/")
            }

            function createFormData(key, file) {
                var data = new FormData()
                data.append("key", key)
                data.append("Content-Type", file.type)
                data.append("file", file)
                data.append("_token", document.querySelector('meta[name=csrf-token]').getAttribute('content'));
                return data
            }
        })();
    </script>
@endsection

@section('content')
    @include('public.blocks.posts.edit_form')
@endsection
