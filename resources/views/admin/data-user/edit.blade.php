<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
  <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
  <h2>Form Edit User</h2>

  @if ($errors->any())
      <div style="color:red;">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form action="{{ route('admin.data-user.update', $user->iduser) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
      <label>Nama:</label><br>
      <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
    </div>

    <div>
      <label>Email:</label><br>
      <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
    </div>

    <div>
      <label>Status:</label><br>
      <select name="status">
        <option value="1" @if ($user->roleuser && $user->roleuser->status == 1) selected @endif>Aktif</option>
        <option value="0" @if ($user->roleuser && $user->roleuser->status == 0) selected @endif>Nonaktif</option>
      </select>
    </div>

    <br>
    <button type="submit">Perbarui</button>
    <a href="{{ route('admin.datauser.index') }}">Batal</a>
  </form>
</body>
</html>