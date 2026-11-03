<!DOCTYPE html>
<html>
<head>
    <title>Add Supplier</title>
</head>
<body>

    <h1>Add New Supplier</h1>

    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf

        <div>
            <label>Supplier Name:</label>
            <input type="text" name="name" value="{{ old('name') }}">

            @error('name')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>City:</label>
            <input type="text" name="city" value="{{ old('city') }}">

            @error('city')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>Phone:</label>
            <input type="text" name="phone" value="{{ old('phone') }}">

            @error('phone')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
<div>
    <label>Email:</label>
    <input type="email" name="email" value="{{ old('email') }}">

    @error('email')
        <p style="color:red">{{ $message }}</p>
    @enderror
</div>
        <button type="submit">Save Supplier</button>
    </form>

    <br>
    <a href="{{ route('suppliers.index') }}">Back to Suppliers</a>

</body>
</html>