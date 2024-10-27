


    <!-- Hero Section Begin -->
    
    <!-- Hero Section End -->
    <!-- Banner Section Begin -->

    <!-- Banner Section End -->

    <section class="product spad mt-5">
        <form method="POST" action="{{ route('submit_review') }}">
            @csrf
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="text" name="user_id" class="form-control" id="user_id" required>
            </div>
            <div class="form-group">
                <label for="order_id">Order ID:</label>
                <input type="text" name="order_id" class="form-control" id="order_id" required>
            </div>
            <div class="form-group">
                <label for="rating">Đánh giá sao:</label>
                <select name="value" class="form-control" id="rating">
                    <option value="1">1 sao</option>
                    <option value="2">2 sao</option>
                    <option value="3">3 sao</option>
                    <option value="4">4 sao</option>
                    <option value="5">5 sao</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Nhận xét:</label>
                <textarea name="comment" class="form-control" id="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
        </form>


    </section>

    <!-- Categories Section Begin -->

    <!-- Categories Section End -->


    <!-- Latest Blog Section Begin -->

    <!-- Latest Blog Section End -->

