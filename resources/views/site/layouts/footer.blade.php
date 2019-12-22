<!-- Start Footer  -->
<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link-contact">
                        <h4>{{trans('site.contact')}}</h4>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>{{trans('site.address')}}</p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>{{trans('site.phone')}} </p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>{{trans('site.email')}} :<a href="mailto:info@venoola.com">info@venoola.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-link">
                        <h4>{{trans('site.menu')}}</h4>
                        <ul>
                            <li><a href="#">{{trans('site.home')}}</a></li>
                            <li><a href="#">{{trans('site.product')}}</a></li>
                            <li><a href="#">{{trans('site.shop')}}</a></li>

                        </ul>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-widget">
                        <h4>{{trans('site.aboutVenoola')}}</h4>
                        <p>{{trans('site.aboutcontent')}}</p>
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
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
<script src="{{url('/')}}/siteDesign/js/rating.min.js"></script>
<script src="{{url('/')}}/siteDesign/js/rater.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.js"></script>
<script src="{{url('/')}}/siteDesign/js/star-rating.js" type="text/javascript"></script>


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
