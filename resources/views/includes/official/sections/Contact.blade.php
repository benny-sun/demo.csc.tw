    <section id="contact">
        <div class="container">
            <h2>聯絡我們</h2>
            <hr class="sep">
            <div class="col-md-8 col-md-offset-2 wow fadeInUp" data-wow-delay=".3s">
                @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <strong style="color:red">{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
                @endif
                <form id="form-contact-info" method="post" action="{{ url('mailto') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" id="Name" name="Name" placeholder="姓名" value="{!! old('Name') !!}" pattern="^([\u4e00-\u9fa5A-z\s]{0,})$" title="請輸入正確的姓名" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Email" name="Email" placeholder="郵箱 / 電話" value="{!! old('Email') !!}" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="Career" name="Career">
                            <option value="">職業</option>
                            <option value="設計師(公司)"@if(old('Career')=='設計師(公司)') selected="selected"  @endif>設計師(公司)</option>
                            <option value="建築師(公司)"@if(old('Career')=='設計師(公司)') selected="selected"  @endif>建築師(公司)</option>
                            <option value="承包廠商"    @if(old('Career')=='承包廠商') selected="selected"  @endif>承包廠商</option>
                            <option value="個人"        @if(old('Career')=='個人') selected="selected"  @endif>個人</option>
                        </select>
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </div>
                    <div class="form-group">
                        <textarea id="Content" name="Content" class="form-control" rows="3" placeholder="訊息" required>{!! old('Content') !!}</textarea>
                    </div>
                    <div class="form-group inner-center">
                        {!! NoCaptcha::display() !!}
                    </div>
                    <button type="submit" id="btn-send-mail" class="btn-block btn">
                        寄送
                    </button>
                    <input type="hidden" name="section_id" value="contact">
                </form>
                <address>
                    <div class="col-md-6 text-left">
                        <h2>康碁有限公司</h2>
                        <h4>Concepoint CO., LTD.</h4>
                        <p class="address"><i class="fa fa-map-marker" aria-hidden="true"></i>
                            桃園市中壢區忠孝路259號2樓</p>
                        <p class="address en">2F, No.259, ZhongXiao road, Zhongli district,
                            Taoyuan city 320, Taiwan</p>
                        <br>
                        <p class="mail"> MAIL: support@csc.tw</p>
                        <p class="tel"> TEL: 03-4551512</p>
                        <p class="fax"> FAX: 03-4550702</p>
                    </div>
                    <!-- Google Map ============ -->
                    <div class="col-md-6">
                        <div id="map"></div>
                    </div>
                </address>

            </div>
        </div>
    </section>