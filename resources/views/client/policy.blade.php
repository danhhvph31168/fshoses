@extends('client.layouts.master')

@section('title')
    Policy's Fshoses
@endsection

@section('content')
    <style>
        body {
            font-family: "Nunito Sans", sans-serif;
            font-size: 20px;
        }

        .container {
            max-width: 1400px;
        }

        .policy .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .policy .divider-1 {
            border-top: 2px solid #000;
            margin: 20px 0;
        }

        .policy .divider-2 {
            border-top: 2px dashed #9d9a9a;
            margin: 20px 0;
        }

        .policy .title-1 {
            font-size: 23px;
            font-weight: bold;
            margin: 0px 0px 30px;
        }

        .policy .cont {
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #000;
            /* Màu chữ đen mặc định */
        }

        p {
            line-height: 1.8em;
            font-size: 15px;
        }

        a:hover {
            color: red;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        .cont ul li::before {
            content: '\25C6';
            color: #000;
            display: inline-block;
            margin-right: 8px;
            font-size: 14px;
        }

        li {
            padding-left: 20px;
            margin-left: 15px;
            font-size: 15px;
        }

        .row .cont {
            line-height: 1.8em;
        }
    </style>
    <main>
        <div class="policy container">
            <div class="row title fw-bold mt-5 mb-5 d-flex justify-content-center" style="font-size: 25px;">CHÍNH SÁCH CHUNG
                TẠI F-SHOES
            </div>
            <div class="row text-1" style="color: #808080; font-size: 16px;">
                <p>Chào mừng bạn đến với <strong>F-shoes</strong><br>
                    Chúng tôi là F-shoes có địa chỉ đăng ký
                    tại Tòa nhà FPT Polytechnic, phố Trịnh Văn Bô, P. Phương Canh, Q. Nam Từ Liêm, TP. Hà Nội. Mã Số
                    Thuế (MST) là: <strong>0 3 1 5 2 2 5 9 2 0</strong>. Thành lập Sàn Giao Dịch Thương Mại Điện Tử
                    thông
                    qua website <a href="http://fshoses.test/"><strong style="padding:0 5px;">fshose.vn</strong></a> đã
                    được đăng ký chính thức với Bộ Công Thương Việt Nam.<br>
                    Khi bạn truy cập vào website <a href="http://fshoses.test/"><strong
                            style="padding:0 5px;">fshose.vn</strong></a> đồng nghĩa với
                    việc bạn đã đồng ý với các điều khoản sử dụng mà chúng tôi đưa ra. <strong>“Điều Khoản Sử Dụng”</strong>
                    có thể được thay đổi, chỉnh sửa, thêm hoặc lược bỏ bất kỳ phần nào, bất kỳ lúc nào và có hiệu lực ngay
                    khi được đăng tải.<br>
                    Dưới đây là chi tiết của <strong>“Điều Khoản Sử Dụng”</strong> mà chúng tôi mong muốn bạn nắm kỹ trong
                    quá trình sử dụng website để có những trải nghiệm mua sắm an toàn và tốt nhất.</p>
            </div>
            <div class="row divider-1"></div>
            <div class="row title-1">1. THƯƠNG HIỆU VÀ BẢN QUYỀN</div>
            <div class="row cont">
                <p class="mb-5">Mọi quyền sở hữu trí tuệ (đã đăng ký hoặc chưa đăng ký), nội dung thông tin và tất cả
                    các thiết kế,
                    văn
                    bản,
                    đồ họa, hình ảnh, video, âm nhạc, mã nguồn,… trong phạm vi website bạn đang xem đều thuộc sở hữu tài
                    sản
                    của
                    <strong>Fshoes</strong>. Toàn bộ nội dung của trang web được bảo vệ bởi luật bản quyền của Việt Nam
                    và
                    các
                    công ước quốc tế.
                </p>
            </div>
            <div class="row divider-2"></div>
            <div class="row title-1">2. QUY ĐỊNH VỀ TRUY CẬP VÀ SỬ DỤNG WEBSITE</div>
            <div class="row cont">
                <p>Khi truy cập vào website của chúng tôi, bạn cần đảm bảo việc bạn có đủ hành vi dân sự để thực hiện
                    các
                    giao
                    dịch mua hàng theo quy định hiện hành của pháp luật Việt Nam. Hãy đảm bảo rằng bạn đã đủ 16 tuổi
                    hoặc
                    truy
                    cập dưới sự giám sát của các thành viên trong gia đình hay người giám hộ hợp pháp.<br />
                    Trong suốt quá trình đăng ký, sử dụng website,&#8230; bạn có toàn quyền quyết định mình sẽ được nhận
                    thư
                    quảng cáo, tin tức về các chương trình khuyến mãi thông qua Email mà bạn đã đăng ký hay không. Nếu
                    không
                    muốn tiếp tục nhận Email từ <strong>Fshoes</strong>, bạn cũng có toàn quyền từ chối bằng cách nhấp
                    vào
                    đường
                    dẫn ở dưới cùng trong thư điện tử được gửi đến bất kỳ.<br />
                    <strong>Fshoes</strong> không mong muốn bạn sử dụng bất kỳ chương trình, công cụ hay hình thức nào
                    khác
                    để
                    can thiệp vào nội dung, hệ thống hay làm thay đổi cấu trúc dữ liệu của website chúng tôi. Các hình
                    thức
                    phát
                    tán, truyền bá, cổ vũ không được phép hay can thiệp, thay đổi, xóa bỏ nội dung, cấu trúc dữ liệu hệ
                    thống
                    của chúng tôi một cách bất hợp pháp đều sẽ có hình thức xử lý từ <strong>Fshoes</strong>. Mọi cá
                    nhân
                    hoặc
                    tổ chức nếu vi phạm sẽ chịu truy tố trước pháp luật và phải bồi thường thiệt hại đã gây ra.
                </p>
            </div>
            <div class="row divider-2"></div>
            <div class="row title-1">3. QUY ĐỊNH VỀ BẢO MẬT THÔNG TIN</div>
            <div class="row cont">
                <p><strong>Fshoes</strong> luôn coi trọng việc bảo mật thông tin và cam kết sẽ sử
                    dụng mọi biện pháp tốt
                    nhất
                    nhằm bảo vệ thông tin bạn đã cung cấp cho chúng tôi.<br />
                    Ở một mặt khác, bạn hoàn toàn có thể truy cập vào website và trình duyệt mà không cần phải cung cấp
                    chi
                    tiết
                    cá nhân. Thông tin của bạn, nếu có, cũng đều sẽ được mã hóa để đảm bảo an toàn trong suốt quá trình
                    giao
                    dịch tại website <strong>Fshoes</strong>. Riêng trường hợp được cơ quan pháp luật yêu cầu, chúng tôi
                    sẽ
                    buộc
                    phải cung cấp những thông tin này cho các cơ quan pháp luật.<br />
                    Vui lòng xem kỹ hơn quy định tại phần <a href="#">Chính sách Bảo mật Thông
                        tin</a>.
                </p>
                <p><b>Fshoes</b><span style="font-weight: 400;"> tuân thủ các biện pháp đảm bảo an toàn/ bảo mật thông
                        tin
                        tài
                        khoản thanh toán cá nhân theo quy định của pháp luật cũng như các quy định và các khuyến nghị về
                        giám
                        sát của Ngân hàng Nhà nước.</span></p>
            </div>
            <div class="row divider-2"></div>
            <div class="row title-1">4. ĐIỀU KHOẢN VỀ THÔNG TIN SẢN PHẨM, GIÁ CẢ, DỊCH VỤ VÀ CÁC NỘI DUNG KHÁC</div>
            <div class="row cont">
                <p>Chúng tôi cam kết sẽ cung cấp thông tin sản phẩm, giá cả, dịch vụ và nội dung khác chính xác nhất đến
                    người
                    dùng. Tuy nhiên, đôi lúc vẫn có sai sót xảy ra, ví dụ như trường hợp giá cả sản phẩm, phí vận
                    chuyển,
                    hình
                    ảnh sản phẩm,… không hiển thị chính xác ở một vài thời điểm và trên một số thiết bị. Tùy theo từng
                    trường
                    hợp cụ thể, <strong>Fshoes</strong> sẽ liên hệ trực tiếp nhằm hướng dẫn hoặc thông báo đến bạn để
                    khắc
                    phục
                    và xử lý.</p>
            </div>
            <div class="row divider-2"></div>
            <div class="row title-1">5. PHƯƠNG THỨC THANH TOÁN</div>
            <div class="row cont">
                <p><span style="font-weight: 400;">Hiện tại, chúng tôi đang có các phương thức thanh toán sau:</span>
                </p>
                <ul>
                    <li style="font-weight: 400;"><span style="font-weight: 400;">COD (cash on delivery): là
                            hình
                            thức
                            thanh toán trực tiếp bằng tiền mặt khi bạn nhận hàng.</span></li>
                    <li style="font-weight: 400;">Thanh toán bằng thẻ nội địa &#8211; được phát hành bởi các
                        ngân
                        hàng
                        trong nước (Vietcombank, Vietinbank, Sacombank,…). Lưu ý: Thẻ của bạn cần được đăng ký
                        dịch
                        vụ
                        thanh toán thực tuyến tại ngân hàng để có thể sử dụng được hình thức này.</li>
                    <li style="font-weight: 400;">Thanh toán bằng QR Code thông qua cổng thanh toán điện tử</li>
                </ul>

            </div>
            <div class="row divider-2"></div>
            <div class="row title-1">6. CHÍNH SÁCH KHUYẾN MÃI</div>
            <div class="row cont">
                <p>Với mong muốn giúp bạn có những trải nghiệm mua sắm tốt nhất, <strong>Fshoes</strong> sẽ áp dụng một
                    số
                    chính
                    sách khuyến mãi cố định hoặc tùy thời điểm về phí giao hàng, quà tặng và ưu đãi đặc biệt.</p>
            </div>
            <div class="row divider-2"></div>
            <div class="row title-1">7. QUY ĐỊNH ĐỔI HÀNG VÀ BẢO HÀNH</div>

            <div class="row cont">
                <p><strong>1. Quy định mua hàng:</strong></p>
                <div class="row cont">
                    <ul>
                        <li style="font-weight: 400;"><span style="font-weight: 400;">Khi mua hàng tại Fshoes khách hàng có
                                thể mua tối đa
                            </span><b>05 sản phẩm </b>cùng loại trên 01 đơn hàng.</li>

                        <li>Đối với những đơn hàng có giá trị trên <strong>5.000.000 VND</strong> (Năm triệu đồng), Fshoes
                            sẽ liên hệ với khách hàng qua số hotline: <strong>1800 5678</strong>
                            để xác nhận và khách hàng vui lòng thanh toán <strong>100%</strong>
                            giá trị đơn hàng qua số tài khoản:
                            <ul>
                                <li style="font-weight: 400;">Ngân hàng thương mại cổ phần kỹ thương Việt Nam - Techcombank</li>
                                <li style="font-weight: 400;">Số tài khoản: 0981208891</li>
                                <li style="font-weight: 400;">Chủ tài khoản: Công ty trách nhiệm hữu hạn Fshoes</li>
                            </ul>
                        </li>
                        <li style="font-weight: 400;"><span style="font-weight: 400;">Sau khi xác nhận là khách hàng đã thanh toán Fshoes sẽ giao hàng cho khách hàng trong thời gian sớm nhất.</li>
                    </ul>
                </div>
                <p><strong>2. Quy định đổi hàng:</strong></p>
                <ul class="mb-3">
                    <li style="font-weight: 400;">Thời hạn đổi sản phẩm là 03 ngày, tính từ ngày nhận
                        được
                        hàng.</li>
                    {{-- <li style="font-weight: 400;">Chỉ áp dụng đổi hàng 01 lần duy nhất cho sản phẩm Giày và Thời trang.
                        Không hỗ
                        trợ đổi sản phẩm thuộc nhóm Phụ kiện.</li> --}}
                    <li style="font-weight: 400;">Sản phẩm đổi phải còn mới, còn nguyên tem, hộp, nhãn mác và chưa có
                        dấu
                        hiệu
                        đã sử dụng, đã giặt tẩy, bám bẩn hay biến dạng.</li>
                    <li style="font-weight: 400;">Fshoes sẽ không áp dụng việc đổi hàng với các sản phẩm
                        đang áp dụng chương trình Sale Off từ 40% trở lên, các sản phẩm thuộc phiên bản giới hạn
                        (limited
                        edition).</li>
                    <li>Tuỳ theo chương trình khuyến mãi, sẽ có thể áp dụng chính sách đổi hàng theo quy định riêng theo
                        từng
                        kênh.</li>
                    <li style="font-weight: 400;">Việc đổi hàng chỉ áp dụng tại đúng kênh (cửa hàng) mà bạn đã mua hàng.
                    </li>
                    <li style="font-weight: 400;">Không áp dụng việc trả hàng &#8211; hoàn tiền trong bất cứ trường hợp
                        nào.
                        Mong bạn thông cảm.</li>
                    <li style="font-weight: 400;">Fshoes ưu tiên hỗ trợ đổi size, đổi màu sắc khác cùng loại. Hoặc trong
                        trường hợp mong muốn đổi sang 01
                        sản
                        phẩm khác, chúng tôi vẫn hỗ trợ bạn:
                        <ul>
                            <li style="font-weight: 400;">Nếu bạn muốn đổi sang sản phẩm có giá trị cao hơn, bạn sẽ cần
                                bù
                                khoản
                                chênh lệch tại thời điểm đổi (nếu có).</li>
                            <li style="font-weight: 400;">Nếu bạn muốn đổi sang sản phẩm có giá trị thấp hơn, chúng tôi
                                sẽ
                                không
                                hoàn lại tiền.</li>
                        </ul>
                    </li>
                </ul>

                <p><strong>3. Quy định bảo hành:</strong></p>
                <div class="row cont">
                    <ul>
                        <li style="font-weight: 400;"><span style="font-weight: 400;">Đối với các sản phẩm giày,
                            </span><span style="font-weight: 400;">Fshoes hỗ trợ bảo hành trong vòng </span><b>06 tháng
                                kể
                                từ ngày
                                mua</b><span style="font-weight: 400;"> với các trường hợp bung keo, sứt chỉ, gãy đế
                                hoặc 1
                                đổi
                                1 với trường hợp phát sinh lỗi từ trong quá trình sản xuất.</span></li>
                        {{-- <li style="font-weight: 400;"><span style="font-weight: 400;">Đối với các sản phẩm thuộc nhóm
                                thời
                                trang
                                và phụ kiện, chính sách bảo hành không được áp dụng. Mong bạn thông cảm.</span></li> --}}
                        <li>Để việc bảo hành thuận tiện và nhanh chóng hơn, bạn vui lòng vệ sinh giày sạch sẽ trước khi
                            gửi
                            về
                            Fshoes. Chúng tôi xin từ chối thực hiện việc bảo hành nếu như sản phẩm chưa được vệ sinh khi
                            nhận
                            được giày.</li>
                    </ul>
                </div>

                <div class="row divider-2"></div>
                <div class="row title-1">9. QUYỀN PHÁP LÝ</div>
                <div class="row cont">
                    <p>Bạn có toàn quyền yêu cầu chúng tôi sửa lại những sai sót trong dữ liệu của bạn. Bất cứ lúc nào
                        bạn
                        cũng
                        có quyền yêu cầu chúng tôi ngưng sử dụng dữ liệu cá nhân của bạn cho mục đích tiếp thị hoặc
                        ngưng
                        nhận
                        thông tin quảng cáo, khuyến mãi từ Fshoes thông qua Email.<br />
                        Các điều kiện, điều khoản và nội dung tại website được điều chỉnh theo luật pháp Việt Nam và Tòa
                        Án
                        có
                        thẩm quyền tại Việt Nam sẽ giải quyết bất kỳ tranh chấp nếu có phát sinh từ việc sử dụng trái
                        phép
                        nội
                        dung.</p>
                </div>
            </div>
        </div>
    </main>
@endsection
