    <section id="section-contact">
        <div class="section-content lazy" style="background: url({{ '../uploads/'.$footer->img }})">
            <div class="container dark-screen">
                <h1 class="onscroll-animate" data-animation="fadeInRight" style="font-size: 46px">聯絡我們</h1>
                <div class="margin-10"></div>
                <div class="row">
                    <ul class="nav nav-tabs">
                        <li class="active tab-width"><a href="#tab1" data-toggle="tab">Email</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="col-md-3 onscroll-animate content-column tab-pane active" data-animation="fadeInUp">

                                <address>
                                    <p><a href="tel:034551512">Tel: (03) 4551512</a></p>
                                    <p><a href="mailto:support@csc.tw">support@csc.tw</a></p>
                                </address>
                            </div>
                            <div class="col-md-9 content-column">
                                <form id="form-contact" action="{{ url('mailto') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5 onscroll-animate" data-animation="fadeInUp" data-delay="350">
                                            <div class="input-container input-name">
                                                <input type="text" name="Name" placeholder="姓名" pattern="^([\u4e00-\u9fa5A-z\s]{0,})$" title="請輸入正確的姓名" required>
                                            </div>
                                            <div class="input-container input-email">
                                                <input type="text" name="Email" placeholder="郵箱 / 電話" required>
                                            </div>
                                            <div class="input-container input-message">
                                                <input type="text" name="Career" placeholder="設計公司 / 個人設計師 / 其他">
                                            </div>
                                        </div>
                                        <div class="col-md-7 onscroll-animate" data-animation="fadeInUp" data-delay="500">
                                            <div class="input-container input-message">
                                                <textarea name="Content" placeholder="訊息內容" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 onscroll-animate inner-right" data-animation="fadeInUp" data-delay="650">
                                            {!! NoCaptcha::display() !!}
                                        </div>
                                    </div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <strong class="return-msg show-return-msg">
                                            {{ $errors->first('g-recaptcha-response') }}
                                        </strong>
                                    @endif
                                    <div class="clearfix onscroll-animate" data-delay="700">
                                        <button class="pull-right btn" type="submit">
                                        寄送
                                        </button>
                                    </div>
                                    <input type="hidden" name="catelog" value="{{ $cover_info->title }}">
                                    <input type="hidden" name="section_id" value="section-contact">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="page-screen-cover"></div>