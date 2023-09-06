



@extends('layouts.app')
@section('content')

<head>
    <script>
        
    onst imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('photo-preview');
    
    imageInput.addEventListener('change', (event) => {
        const image = event.target.files[0];
        imagePreview.src = URL.createObjectURL(image);
    });
        
    </script>

</head>
<form action="{{ route('media.updateImage') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image" >
    </div>

    <button type="submit" class="btn btn-primary">Upload</button>


<div  style="display:none;" id="image_container" class="card">
    <img  style="width:400px;" class="card-img-top" id="photo-preview" alt="Image preview">
    <div class="card-body">

        
        <h5 class="card-title">Image preview</h5>
        <p class="card-text">This is a preview of an image.</p>

     
    </div>
</div>
</form>

<script> 
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('photo-preview');
    const imageCard = document.getElementById("image_container");

    
    imageInput.addEventListener('change', (event) => {
        const image = event.target.files[0];
        imagePreview.src = URL.createObjectURL(image);
        imageCard.style.display = "block";
    });
        
    </script>

@endsection

