<?php
include("parts/header.php");
?>
<div class="bg-info">
    <div class="container p-5">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="shadow-lg p-3 bg-light mb-5 rounded">
                        <div class="mt-2 mb-2 text-center">
                            <i class="fa fa-home fa-5x" style="width:100px;height:100px;"></i>
                        </div>
                        <h5 class="text-center">Lira City, P.O Box 256. UG</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="shadow-lg p-3 bg-light mb-5 rounded">
                        <div class="mt-2 mb-2 text-center">
                            <i class="fa fa-phone fa-5x" style="width:100px;height:100px;"></i>
                        </div>
                        <h5 class="text-center">+256 780000000</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="shadow-lg p-3 bg-light mb-5 rounded">
                        <div class="mt-2 mb-2 text-center">
                            <i class="fa fa-envelope fa-5x" style="width:100px;height:100px;"></i>
                        </div>
                        <h5 class="text-center"><a href="mailto:info@stelizabeth.ug" class="nav-link">info@stelizabeth.ug</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="shadow-lg p-3 bg-light mb-5 rounded">
                            <h2 class="text-center text-primary">Contact Us</h2>
                            <form action="" method="post">
                                <div class="form-group my-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                                <div class="form-group my-3">
                                    <label for="" class="form-label">Phone Number</label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                                <div class="form-group my-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" name="" id="" class="form-control">
                                </div>
                                <div class="form-group my-3">
                                    <label for="" class="form-label">Message</label>
                                    <textarea name="" id="" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group my-3">
                                    <input type="button" value="SEND" class="btn btn-primary form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container-fluid p-5 bg-dark">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="h4 text-white">St. Elizabeth Hospital</h4>
                </div>
                <div class="col-md-3">
                    <h4 class="text-white text-left">Resources</h4>
                    <h4 style="width:70px;border-bottom:2px solid white;"></h4>
                    <div class="nav mt-2 d-block">
                        <a href="" class="nav-link text-white">Jop Application</a>
                        <a href="" class="nav-link text-white">Documentation</a>
                        <a href="" class="nav-link text-white">FAQs</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4 class="text-white text-left">Useful Links</h4>
                    <h4 style="width:70px;border-bottom:2px solid white;"></h4>
                    <div class="nav mt-2 d-block">
                        <a href="" class="nav-link text-white">About Us</a>
                        <a href="" class="nav-link text-white">Register</a>
                        <a href="" class="nav-link text-white">Help</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4 class="text-white text-left">Contact</h4>
                    <h4 style="width:70px;border-bottom:2px solid white;"></h4>
                    <h6 class="text-white my-2"><i class="fa fa-home"></i> Lira City, P.O Box 256. UG</h6>
                    <h6 class="text-white d-flex my-2"><i class="fa fa-envelope"></i> &nbsp;<a href="mailto:info@stelizabeth.ug" class="nav-link text-white">info@stelizabeth.ug</a></h6>
                    <h6 class="text-white my-2"><i class="fa fa-phone"></i> +256 780000000</h6>
                    <h6 class="text-white my-2">Toll free : +256 7899999999</h6>
                </div>
            </div>
        </div>
        <div style="width:100%;border-bottom:1px solid white;" class="mt-3 mb-3"></div>
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-white">&copy; 2023 St. Elizabeth Hospital All Rights Reserved.</h5>
                    </div>
                    <div class="col-md-6 d-flex" style="justify-content:end;">
                        <a href="" class="nav-link text-white me-3"><i class="fa fa-facebook"></i></a>
                        <a href="" class="nav-link text-white me-3"><i class="fa fa-whatsapp"></i></a>
                        <a href="" class="nav-link text-white me-3"><i class="fa fa-twitter"></i></a>
                        <a href="" class="nav-link text-white me-3"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</footer>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/alertify/alertify.min.js"></script>
<script>
        document.addEventListener("DOMContentLoaded", function(){
            el_autohide = document.querySelector('.autohide');

            if(el_autohide){
                var last_scroll_top = 0;
            window.addEventListener('scroll', function(){
                let scroll_top = window.scrollY;
                if(scroll_top < last_scroll_top){
                    el_autohide.classList.remove('scrolled-down');
                    el_autohide.classList.add('scrolled-up');
                }else{
                    el_autohide.classList.remove('scrolled-up');
                    el_autohide.classList.add('scrolled-down');
                }
                last_scroll_top = scroll_top;
            });
            }

        });
    </script>
</body>

</html>