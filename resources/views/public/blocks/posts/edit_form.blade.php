<div class="pl-3 pr-3 pt-3 pb-1 bg-white rounded shadow-sm mb-4 mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">{{__('post.create')}}</h4>
            <form class="needs-validation mb-3" novalidate="" method="POST" action="{{(isset($post) && $post) ? route('posts.update', $post) : route('posts.store')}}">
                @csrf
                @if(isset($post) && $post)
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="title">{{__('post.title')}}</label>
                    <input type="text"
                           class="form-control"
                           id="title"
                           placeholder="{{__('post.title_placeholder')}}"
                           required=""
                           name="title"
                           value="{{old('title') ?? $post->title ?? ''}}"
                    >
                    <div class="invalid-feedback">
                        {{__('post.title_validation_error')}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="content">{{__('post.content')}}</label>
                    {{--<textarea class="form-control" id="content" required="" name="content" rows="15">{{old('content') ?? $post->content ?? ''}}</textarea>--}}

                    <input type="hidden" value="{{old('content') ?? $post->content ?? ''}}" id="content" name="content">
                    <trix-editor input="content"></trix-editor>

                    <div class="invalid-feedback">
                        {{__('post.content_validation_error')}}
                    </div>
                </div>

                <button class="btn btn-primary btn-lg btn-block" type="submit">{{isset($post) ? __('post.update') :__('post.submit')}}</button>
            </form>
        </div>
    </div>
</div>
