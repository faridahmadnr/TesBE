# COLUMNS STRUCTURE

> Catatan: kolom dan tipe data ditulis berdasarkan hasil query `information_schema.columns` atau dokumentasi manual.

## Table: events
| Column | Data Type | Nullable | Key | Description | Notes |
|---------|------------|----------|-----|-------------|--------|
| id | bigint | NO | PK | Primary key |  |
| user_id | bigint | YES | FK (users.id) | User yang memicu event |  |
| session_id | varchar | YES | FK (sessions.id) | ID sesi user |  |
| name | varchar | NO |  | Nama event |  |
| ip_address | varchar | YES |  | IP pengunjung |  |
| created_at | timestamp | YES |  | Waktu event terjadi |  |

---

## Table: users
| Column | Data Type | Nullable | Key | Description | Notes |
|---------|------------|----------|-----|-------------|--------|
| id | bigint | NO | PK | Primary key |  |
| name | varchar | NO |  | Nama user |  |
| email | varchar | NO |  | Email user |  |
| role_id | bigint | YES | FK (roles.id) | Role user |  |
| created_at | timestamp | YES |  | Waktu dibuat |  |

---

## Table: sessions
| Column | Data Type | Nullable | Key | Description | Notes |
|---------|------------|----------|-----|-------------|--------|
| id | varchar | NO | PK | Session ID |  |
| user_id | bigint | YES | FK (users.id) | User yang punya sesi |  |
| ip_address | varchar | YES |  | IP address sesi |  |
| user_agent | text | YES |  | Info browser/device |  |
| last_activity | timestamp | YES |  | Waktu terakhir aktif |  |

---
 ## Table: actiity_log