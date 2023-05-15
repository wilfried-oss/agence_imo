 @if (session('success'))
     <div class="alert alert-success text-center flash-message">
         {{ session('success') }}
     </div>
 @elseif (session('error'))
     <div class="alert alert-danger text-center flash-message">
         {{ session('error') }}
     </div>
 @endif
