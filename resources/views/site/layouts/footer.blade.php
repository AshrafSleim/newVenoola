<!-- Start Footer  -->
<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget">
                        <h4>About ThewayShop</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link">
                        <h4>Information</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Customer Service</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Delivery Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link-contact">
                        <h4>Contact Us</h4>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 3756 <br>Preston Street Wichita,<br> KS 67213 </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer  -->

<!-- Start copyright  -->
<div class="footer-copyright">
    <p class="footer-company">All Rights Reserved. &copy; 2019 <a href="#" style="color:#dc3545">Venoola</a> Developed and Designed By :
        <a href="https://tacweed.com" style="color:#dc3545">Tacweed</a></p>
</div>
<!-- End copyright  -->

<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

<!-- ALL JS FILES -->
<script src="{{url('/')}}/siteDesign/js/jquery-3.2.1.min.js"></script>
<script src="{{url('/')}}/siteDesign/js/popper.min.js"></script>
<script src="{{url('/')}}/siteDesign/js/bootstrap.min.js"></script>
<!-- ALL PLUGINS -->
<script src="{{url('/')}}/siteDesign/js/jquery.superslides.min.js"></script>
<script src="{{url('/')}}/siteDesign/js/bootstrap-select.js"></script>
<script src="{{url('/')}}/siteDesign/js/inewsticker.js"></script>
<script src="{{url('/')}}/siteDesign/js/bootsnav.js"></script>
<script src="{{url('/')}}/siteDesign/js/images-loded.min.js"></script>
<script src="{{url('/')}}/siteDesign/js/isotope.min.js"></script>
<script src="{{url('/')}}/siteDesign/js/owl.carousel.min.js"></script>
<script src="{{url('/')}}/siteDesign/js/baguetteBox.min.js"></script>
<script src="{{url('/')}}/siteDesign/js/form-validator.min.js"></script>
<script src="{{url('/')}}/siteDesign/js/contact-form-script.js"></script>
<script src="{{url('/')}}/siteDesign/js/custom.js"></script>
<script>
    $('.cart').on('click' ,function(){
        var id=parseInt($(this).attr('id'));

        $.ajax({
            url:"{{url('/')}}/shoping",
            dataType:'json',
            type:'post',
            data:{_token:'{{ csrf_token() }}',id:id},
            success:function (data) {

                $('.badge').text(data.count);
            },
            error:function()
            {
                alert('try again');
            }

        });
        return false;
    });

</script>
<script>
    function counter(id){

        var id =id;
        var conter=document.getElementById(id).value;
        var price=document.getElementById("price"+id).innerText;
        var newValue=Number(price)*Number(conter);
        $("#total"+id).text(newValue);
        $.ajax({
            url:"{{url('/')}}/shoping/"+id,
            dataType:'json',
            type:'get',
            data:{id:id,conter:conter },
            success:function (data) {

                $('.badge').text(data.count);
                $('.totalOrder').text(data.total);
            },
            error:function()
            {
                alert('try again');
            }

        });

    }

</script>
@include('sweetalert::alert')

</body>

</html>
