# Folder Logo Ormada

## Lokasi Penempatan Logo

Simpan semua logo organisasi mahasiswa daerah (Ormada) di folder ini.

## Daftar Logo yang Diperlukan

Berikut adalah nama file logo yang harus disiapkan untuk setiap ormada:

1. **imms-logo.png** - Logo IMMS (Ikatan Mahasiswa Magetan di Surabaya)
2. **pamelo-logo.png** - Logo Pamelo (Paguyuban Mahasiswa Magetan Solo)
3. **kommma-logo.png** - Logo KOMMMA (Komunitas Mahasiswa Magetan di Malang)
4. **impata-logo.png** - Logo IMPATA (Ikatan Mahasiswa dan Alumni Pelajar di Bogor)
5. **imaginer-logo.png** - Logo IMAGINER (Ikatan Mahasiswa Magetan ing Jember)
6. **images-logo.png** - Logo IMAGES (Ikatan Mahasiswa Magetan di Semarang)
7. **fomagta-logo.png** - Logo FOMAGTA (Forum Mahasiswa Magetan Yogyakarta)

## Spesifikasi Logo

### Format File

-   **Format**: PNG dengan background transparan (recommended)
-   **Alternatif**: JPG atau SVG

### Dimensi

-   **Ukuran Optimal**: 512x512 pixels (rasio 1:1)
-   **Ukuran Minimum**: 256x256 pixels
-   **Ukuran Maksimum**: 1024x1024 pixels

### Kualitas

-   **Resolusi**: 72-300 DPI
-   **File Size**: Maksimal 500KB per logo untuk performa optimal
-   **Background**: Transparan (PNG) atau putih bersih

## Contoh Penempatan File

```
public/
  └── images/
      └── ormada/
          ├── README.md (file ini)
          ├── imms-logo.png
          ├── pamelo-logo.png
          ├── kommma-logo.png
          ├── impata-logo.png
          ├── imaginer-logo.png
          ├── images-logo.png
          └── fomagta-logo.png
```

## Path dalam Kode

Logo akan dipanggil menggunakan:

```blade
{{ asset('images/ormada/nama-logo.png') }}
```

## Fallback

Jika logo belum tersedia, sistem akan menampilkan icon 🎓 sebagai placeholder.

## Catatan Penting

-   Pastikan nama file logo **persis** sesuai dengan daftar di atas (huruf kecil semua, gunakan tanda hubung)
-   Gunakan background transparan untuk hasil terbaik
-   Pastikan logo memiliki kualitas tinggi dan tidak buram
-   Test tampilan logo di browser setelah upload

---

**Dibuat untuk**: Magetan Campus Expo 2026
**Terakhir diupdate**: 17 Desember 2025
