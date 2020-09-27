<div class="pl-3 pr-3 pt-1 pb-1 bg-white rounded mb-4 mt-3">
    <div class="order-md-1">
        <div class="mb-2">
            <strong class="pb-3">Ответить</strong>
        </div>
        <form class="needs-validation mb-3" id="commentaty-form" novalidate="" method="POST" action="{{route('post.commentary.create')}}">
            @csrf
            <div class="mb-3">
                <textarea class="form-control" id="content" required="" name="content" rows="15"></textarea>
                <div class="invalid-feedback">
                    {{$errors->first()}}
                </div>
            </div>
            <input type="hidden" name="parent_id" id="commentary-parent-id" value="">
            <input type="hidden" name="post_id" id="commentary-post-id" value="">
            <button class="btn btn-primary btn-lg btn-block" type="submit">{{__('post.commentary.submit')}}</button>
        </form>
    </div>
</div>
