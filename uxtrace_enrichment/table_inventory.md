# TABLES INVENTORY

| No | Table Name | Description | Notes |
|----|-------------|-------------|-------|
| 1 | events | Menyimpan data event yang terjadi di website (click, view, dll) |  |
| 2 | users | Menyimpan data user aplikasi |  |
| 3 | sessions | Menyimpan data sesi aktif user |  |
| 4 | activity_log | Menyimpan log aktivitas sistem / user |  |
| 5 | permissions | Menyimpan daftar permission sistem |  |
| 6 | model_has_permissions | Relasi polymorphic antara model dan permission |  |
| 7 | role_has_permissions | Relasi antara role dan permission |  |
| 8 | jobs | Menyimpan daftar background job |  |
| 9 | failed_jobs | Menyimpan job yang gagal dieksekusi |  |
| 10 | roles | Menyimpan data role user (jika ada) |  |
