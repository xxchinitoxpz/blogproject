<!DOCTYPE html>
<html>

<head>
    @include('admin.admincss')
</head>

<body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            @include('admin.body')
            
            @include('admin.footer')
        </div>
    </div>
    <!-- JavaScript files-->
    
</body>

</html>
