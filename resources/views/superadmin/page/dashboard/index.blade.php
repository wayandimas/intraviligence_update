@include('superadmin.partials.header')
@include('superadmin.partials.navbar')
<!-- Start right Content here -->

<div class="content-page">
    <!-- Start content -->
    <div class="content">

        <h2>Selamat Datang {{ Auth::user()->nama }}</h2>
    </div>
</div><!-- container -->


</div> <!-- Page content Wrapper -->

</div> <!-- content -->

 <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <!-- Isi footer, misalnya informasi tambahan, tautan, dll. -->
                <p>&copy; 2023 Developed By Teknik Komputer dan Jaringan PNUP</p>
            </div>
        </div>
    </div>
</footer>

</div>
<!-- End Right content here -->

</div>
<!-- END wrapper -->
@include('superadmin.partials.footer')
