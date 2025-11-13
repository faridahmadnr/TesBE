# MAPPING RELATIONS

> Catatan: Diisi berdasarkan hasil pengamatan atau dugaan logis relasi antar tabel.

| SOURCE_TABLE | SOURCE_COLUMN | TARGET_TABLE | TARGET_COLUMN | RELATION TYPE | NOTES |
|---------------|----------------|---------------|----------------|----------------|--------|
| events | user_id | users | id | Many-to-One | Setiap event dimiliki oleh satu user |
| events | session_id | sessions | id | Many-to-One | Event terkait dengan satu sesi |
| sessions | user_id | users | id | Many-to-One | Satu user bisa punya banyak sesi |
| activity_log | causer_id | users | id | Polymorphic | Jika `causer_type = 'App\\Models\\User'` |
| model_has_permissions | model_id | users | id | Polymorphic | model_type = 'App\\Models\\User' |
| role_has_permissions | role_id | roles | id | Many-to-One | Role memiliki beberapa permission |
| permissions | id | model_has_permissions | permission_id | One-to-Many | Permission digunakan oleh banyak model |
| failed_jobs | job_id | jobs | id | None | Log job gagal | 
|  |  |  |  |  |  |



| SOURCE_TABLE          | SOURCE_COLUMN | TARGET_TABLE          | TARGET_COLUMN | RELATION TYPE | NOTES                                   |
| --------------------- | ------------- | --------------------- | ------------- | ------------- | --------------------------------------- |
| events                | user_id       | users                 | id            | Many-to-One   | Cast user_id (varchar) → bigint         |
| sessions              | user_id       | users                 | id            | Many-to-One   | User dapat memiliki banyak sesi         |
| activity_log          | causer_id     | users                 | id            | Polymorphic   | Jika `causer_type='App\\Models\\User'`  |
| model_has_permissions | model_id      | users                 | id            | Polymorphic   | model_type='App\Models\User'            |
| permissions           | id            | model_has_permissions | permission_id | One-to-Many   | Satu permission bisa punya banyak model |
| role_has_permissions  | permission_id | permissions           | id            | Many-to-One   | Permission dikaitkan ke role tertentu   |
| failed_jobs           | —             | jobs                  | —             | None          | Tidak ada relasi langsung (independen)  |



