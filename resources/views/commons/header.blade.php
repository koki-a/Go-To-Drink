<body>
    <header>
        <div class="header_inner inner">
            <div class="">
                <a href="{{ route('shops.top') }}" class="header_logo">Go To Drink</a>
            </div>
            <nav class="header_nav">
                <ul class="header_list">
                    @guest
                    <li class="header_item"><a href="{{ route('register') }}" class="header_link">ユーザ登録</a></li>
                    <li class="header_item"><a href="{{ route('login') }}" class="header_link">ログイン</a></li>
                    @else
                    <li class="header_item"><a href="{{ route('shops.create') }}" class="header_link">投稿する</a></li>
                    <li class="header_item"><button form="logout-button" class="logout_button" type="submit">
                        ログアウト
                    </button>
                    </li>
                    <form id="logout-button" method="POST" action="{{ route('logout') }}">
                    @csrf
                    </form>
                    <li class="header_item"><a href="{{ route('users.show',['name' => Auth::user()->name]) }}" class="header_link">マイページ</a></li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>