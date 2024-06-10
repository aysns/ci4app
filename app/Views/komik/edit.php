<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col">
      <h2 class="judul">Form Ubah Data Komik</h2>

      <form action="/komik/update/<?= $komik['id']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
        <input type="hidden" name="sampulLama" value="<?= $komik['sampul']; ?>">
        <div class="row mb-3">
          <label for="judul" class="col-sm-2 col-form-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('errors') && array_key_exists('judul', session('errors'))) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $komik['judul'] ?>">
            <div class="invalid-feedback">
              <?= session('errors')['judul'] ?? '' ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('errors') && array_key_exists('penulis', session('errors'))) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis'] ?>">
            <div class="invalid-feedback">
              <?= session('errors')['penulis'] ?? '' ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control <?= (session('errors') && array_key_exists('penerbit', session('errors'))) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit'] ?>">
            <div class="invalid-feedback">
              <?= session('errors')['penulis'] ?? '' ?>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
          <div class="col-sm-2">
            <img src="/img/<?= $komik['sampul']; ?>" class="img-thumbnail img-preview">
          </div>
          <div class="col-sm-8">
            <div class="mb-3">
              <input class="form-control <?= (session('errors') && array_key_exists('sampul', session('errors'))) ? 'is-invalid' : ''; ?>" type="file" id="sampul" name="sampul" onchange="previewImg()">
              <div class="invalid-feedback">
                <?= session('errors')['sampul'] ?? '' ?>
              </div>
              <label for="Sampul" class="form-label"><?= $komik['sampul']; ?></label>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Ubah data</button>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>