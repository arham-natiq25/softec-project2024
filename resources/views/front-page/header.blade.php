<header class="header">
    <nav>
        <div class="nav__logo">
            <a href="#">Air Travels</a>
        </div>
        <ul class="nav__links">
            <li class="link">
                <a href="#home">Home</a>
            </li>
            <li class="link">
                <a href="#trending">Umrah Package</a>
            </li>
            <li class="link">
                <a href="#destination">Hajj Package</a>
            </li>
            <li class="link">
                <a href="#guide">Guide</a>
            </li>
            <li class="link">
                <a href="{{!auth()->check() ? route('login') : route('dashboard')  }}">{{!auth()->check() ? 'Login' : 'Dashboard'  }}</a>
            </li>
        </ul>
    </nav>
    <div class="section__container header__container" id="home">
        <h1>Explore the beauty of nature Discover the new you</h1>
        <div class="header__form">
            <form action="/">
                <div class="input__group">
                    <label for="destination">Where do you want to go?</label>
                    <input type="number" placeholder="Country, ZIP" />
                </div>
                <div class="input__group">
                    <label for="checkIn">Check In</label>
                    <input type="date" placeholder="Choose a date" />
                </div>
                <div class="input__group">
                    <label for="CheckOut">Check Out</label>
                    <input type="date" placeholder="Choose a date" />
                </div>
                <div class="input__group">
                    <label for="guests">Guests</label>
                    <input type="number" placeholder="Number of guests" />
                </div>
                <button class="btn">CHECK AVAILABILITY</button>
            </form>
        </div>
    </div>
</header>
