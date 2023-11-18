<div>
    <div class="comment-form">
        <h4 class="mb-15">Thêm bình luận</h4>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <form class="form-contact comment_form" id="commentForm" wire:submit="saveComment">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="comment" id="name" type="text"
                                    wire:model="comment"
                                    placeholder="Nội dung..." />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button button-contactForm">Bình luận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
