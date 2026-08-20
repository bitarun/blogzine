<h1 class="mb-4 h3">افزودن دسته بندی </h1>
<div class="row pb-4 bg-light p-3 mb-4 rounded">
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <label class="form-label">نام </label>
                <input name="name" type="text" class="form-control" placeholder="نام دست بندی ..."
                       value="{{ old('name') }}">
                @error('name')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-sm-12 col-md-4">
                <label class="form-label">نام انگلیسی </label>
                <input name="en_name" type="text" class="form-control" placeholder="نام انگلیسی دست بندی ..."
                       value="{{ old('en_name') }}">
                @error('en_name')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-sm-12 col-md-4 ">
                <label class="form-label">توضیحات</label>
                <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                @error('description')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-sm-12 col-md-4 mt-3">
                <label class="form-label">آیکون</label>
                <select class="form-control" name="icon">
                    <option value="⚽️">⚽️ اخبار ورزشی</option>
                    <option value="🏀"> 🏀</option>
                    <option value="🏈">🏈</option>
                    <option value="🏆">🏆</option>
                    <option value="🎾">🎾</option>
                    <option value="🏛️">🏛️ اخبار سیاسی</option>
                    <option value="🗳️">🗳️</option>
                    <option value="🌍">🌍</option>
                    <option value="📊">📊</option>
                    <option value="📈">📈 اخبار اقتصادی</option>
                    <option value="💰">💰</option>
                    <option value="📉">📉</option>
                    <option value="🏦">🏦</option>
                    <option value="💵">💵</option>
                    <option value="🎨">🎨 اخبار هنری</option>
                    <option value="🖼️">🖼️</option>
                    <option value="🖌️">🖌️</option>
                    <option value="🎭">🎭</option>
                    <option value="🎬">🎬</option>
                    <option value="🎭">🎭 اخبار فرهنگی</option>
                    <option value="🎨">🎨</option>
                    <option value="📚">📚</option>
                    <option value="🎶">🎶</option>
                    <option value="🕌">🕌</option>
                    <option value="✈️">✈️ اخبار گردشگری</option>
                    <option value="🌍">🌍</option>
                    <option value="🏖️">🏖️</option>
                    <option value="🗺️">🗺️</option>
                    <option value="🏕️">🏕️</option>
                    <option value="💻">💻 اخبار فناوری و تکنولوژی</option>
                    <option value="📱">📱</option>
                    <option value="🔧">🔧</option>
                    <option value="🖥️">🖥️</option>
                    <option value="🚀">🚀</option>
                </select>

                @error('icon')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-sm-12 col-md-2 d-flex align-items-center mt-5">
                <input class="btn btn-success w-100 m-0" type="submit" value="ثبت">
            </div>
        </div>
    </form>
</div>
