<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h2 class="judul">Form Tambah Data Komik</h2>

      <form action="/komik/save" method="post">
        <?= csrf_field(); ?>
        <div class="row mb-3">
          <label for="judul" class="col-sm-2 col-form-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('errors') && array_key_exists('judul', session('errors'))) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
            <div class="invalid-feedback">
              <?= session('errors')['judul'] ?? '' ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('errors') && array_key_exists('penulis', session('errors'))) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
            <div class="invalid-feedback">
              <?= session('errors')['penulis'] ?? '' ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('errors') && array_key_exists('penerbit', session('errors'))) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
            <div class="invalid-feedback">
              <?= session('errors')['penulis'] ?? '' ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="sampul" name="sampul" value="<?= old('sampul'); ?>">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Tambah data</button>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>