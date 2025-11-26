# VIEW TABLE FOR KUR_PAGE_ENTER (62 KOLOM)

CREATE OR REPLACE VIEW v_kur_page_enter AS
SELECT
    e.id AS event_id,
    e.user_id::bigint AS user_id,
    e.event_name,

    e.event_properties->>'page_marker' AS page_marker,
    e.event_properties->>'previous_page_marker' AS previous_page_marker,
    e.event_properties->>'pre_previous_marker' AS pre_previous_marker,
    e.event_properties->>'page_name' AS page_name,
    e.event_properties->>'previous_page_name' AS previous_page_name,
    e.event_properties->>'entry_source' AS entry_source,
    e.event_properties->>'entry_method' AS entry_method,
    e.event_properties->>'area_page' AS area_page,

    u.name AS user_name,
    u.email AS user_email,
    u.email_verified_at,
	u.password,
    u.password_changed_at,
    u.active AS user_active,
    u.last_login_at,
    u.last_login_ip,
    u.status AS user_status,
	u.remember_token,
    u.created_at AS user_created_at,
    u.updated_at AS user_updated_at,
	u.deleted_at AS user_deleted_at,

    s.id AS session_id,
    s.ip_address AS session_ip,
    s.user_agent AS session_user_agent,
    s.payload AS session_payload,
    s.last_activity AS session_last_activity,

    al.id AS activity_id,
    al.log_name AS activity_log_name,
    al.description AS activity_description,
    al.subject_type,
    al.subject_id,
    al.causer_type,
    al.properties AS activity_properties,
    al.event AS activity_event,
    al.created_at AS activity_created_at,
    al.updated_at AS activity_updated_at,

    mhp.permission_id AS model_permission_id,
    mhp.model_type AS model_permission_type,

    p.name AS permission_name,
    p.guard_name,
    p.description AS permission_description,
    p.sort AS permission_sort,
    p.created_at AS permission_created_at,
    p.updated_at AS permission_updated_at,

    rhp.role_id AS role_id_linked,

    j.id AS job_id,
    j.queue AS job_queue,
    j.payload AS job_payload,
    j.attempts AS job_attempts,
    j.reserved_at,
    j.available_at,
    j.created_at AS job_created_at,

    fj.id AS failed_job_id,
    fj.uuid AS failed_uuid,
    fj.connection AS failed_connection,
    fj.queue AS failed_queue,
    fj.payload AS failed_payload,
    fj.exception AS failed_exception,
    fj.failed_at AS failed_timestamp

FROM events e

LEFT JOIN users u 
    ON u.id = e.user_id::bigint

LEFT JOIN sessions s 
    ON s.user_id = u.id

LEFT JOIN activity_log al 
    ON al.causer_id = u.id 
   AND al.causer_type = 'App\\Models\\User'

LEFT JOIN model_has_permissions mhp 
    ON mhp.model_id = u.id
   AND mhp.model_type = 'App\\Models\\User'

LEFT JOIN permissions p 
    ON p.id = mhp.permission_id

LEFT JOIN role_has_permissions rhp 
    ON rhp.permission_id = p.id

LEFT JOIN jobs j 
    ON j.id IS NOT NULL 

LEFT JOIN failed_jobs fj 
    ON fj.queue = j.queue

WHERE e.event_name = 'kur_page_enter';


# VIEW TABLE FOR KUR_PAGE_STAY (64 KOLOM)

CREATE OR REPLACE VIEW v_kur_page_stay AS
SELECT
    e.id AS event_id,
    e.user_id::bigint AS user_id,
    e.event_name,

    e.event_properties->>'page_marker' AS page_marker,
    e.event_properties->>'previous_page_marker' AS previous_page_marker,
    e.event_properties->>'pre_previous_marker' AS pre_previous_marker,
    e.event_properties->>'page_name' AS page_name,
    e.event_properties->>'previous_page_name' AS previous_page_name,
    e.event_properties->>'entry_source' AS entry_source,
    e.event_properties->>'entry_method' AS entry_method,
    e.event_properties->>'area_page' AS area_page,
    e.event_properties->>'time_stay' AS time_stay,
    e.event_properties->>'type_quit' AS type_quit

    u.name AS user_name,
    u.email AS user_email,
    u.email_verified_at,
	u.password,
    u.password_changed_at,
    u.active AS user_active,
    u.last_login_at,
    u.last_login_ip,
    u.status AS user_status,
	u.remember_token,
    u.created_at AS user_created_at,
    u.updated_at AS user_updated_at,
	u.deleted_at AS user_deleted_at,

    s.id AS session_id,
    s.ip_address AS session_ip,
    s.user_agent AS session_user_agent,
    s.payload AS session_payload,
    s.last_activity AS session_last_activity,

    al.id AS activity_id,
    al.log_name AS activity_log_name,
    al.description AS activity_description,
    al.subject_type,
    al.subject_id,
    al.causer_type,
    al.properties AS activity_properties,
    al.event AS activity_event,
    al.created_at AS activity_created_at,
    al.updated_at AS activity_updated_at,

    mhp.permission_id AS model_permission_id,
    mhp.model_type AS model_permission_type,

    p.name AS permission_name,
    p.guard_name,
    p.description AS permission_description,
    p.sort AS permission_sort,
    p.created_at AS permission_created_at,
    p.updated_at AS permission_updated_at,

    rhp.role_id AS role_id_linked,

    j.id AS job_id,
    j.queue AS job_queue,
    j.payload AS job_payload,
    j.attempts AS job_attempts,
    j.reserved_at,
    j.available_at,
    j.created_at AS job_created_at,

    fj.id AS failed_job_id,
    fj.uuid AS failed_uuid,
    fj.connection AS failed_connection,
    fj.queue AS failed_queue,
    fj.payload AS failed_payload,
    fj.exception AS failed_exception,
    fj.failed_at AS failed_timestamp

FROM events e

LEFT JOIN users u 
    ON u.id = e.user_id::bigint

LEFT JOIN sessions s 
    ON s.user_id = u.id

LEFT JOIN activity_log al 
    ON al.causer_id = u.id 
   AND al.causer_type = 'App\\Models\\User'

LEFT JOIN model_has_permissions mhp 
    ON mhp.model_id = u.id
   AND mhp.model_type = 'App\\Models\\User'

LEFT JOIN permissions p 
    ON p.id = mhp.permission_id

LEFT JOIN role_has_permissions rhp 
    ON rhp.permission_id = p.id

LEFT JOIN jobs j 
    ON j.id IS NOT NULL 

LEFT JOIN failed_jobs fj 
    ON fj.queue = j.queue

WHERE e.event_name = 'kur_page_stay';


# VIEW TABLE FOR KUR_PAGE_SLIDE (65 kolom)

CREATE OR REPLACE VIEW v_kur_page_slide AS
SELECT
    e.id AS event_id,
    e.user_id::bigint AS user_id,
    e.event_name,

    e.event_properties->>'page_marker' AS page_marker,
    e.event_properties->>'previous_page_marker' AS previous_page_marker,
    e.event_properties->>'pre_previous_marker' AS pre_previous_marker,
    e.event_properties->>'page_name' AS page_name,
    e.event_properties->>'entry_source' AS entry_source,
    e.event_properties->>'previous_page_name' AS previous_page_name,
    e.event_properties->>'entry_method' AS entry_method,
    e.event_properties->>'area_page' AS area_page,
    e.event_properties->>'radius_top' AS radius_top,
    e.event_properties->>'scroll_radius' AS scroll_radius,
    e.event_properties->>'type_scroll' AS type_scroll,


    u.name AS user_name,
    u.email AS user_email,
    u.email_verified_at,
	u.password,
    u.password_changed_at,
    u.active AS user_active,
    u.last_login_at,
    u.last_login_ip,
    u.status AS user_status,
	u.remember_token,
    u.created_at AS user_created_at,
    u.updated_at AS user_updated_at,
	u.deleted_at AS user_deleted_at,

    s.id AS session_id,
    s.ip_address AS session_ip,
    s.user_agent AS session_user_agent,
    s.payload AS session_payload,
    s.last_activity AS session_last_activity,

    al.id AS activity_id,
    al.log_name AS activity_log_name,
    al.description AS activity_description,
    al.subject_type,
    al.subject_id,
    al.causer_type,
    al.properties AS activity_properties,
    al.event AS activity_event,
    al.created_at AS activity_created_at,
    al.updated_at AS activity_updated_at,

    mhp.permission_id AS model_permission_id,
    mhp.model_type AS model_permission_type,

    p.name AS permission_name,
    p.guard_name,
    p.description AS permission_description,
    p.sort AS permission_sort,
    p.created_at AS permission_created_at,
    p.updated_at AS permission_updated_at,

    rhp.role_id AS role_id_linked,

    j.id AS job_id,
    j.queue AS job_queue,
    j.payload AS job_payload,
    j.attempts AS job_attempts,
    j.reserved_at,
    j.available_at,
    j.created_at AS job_created_at,

    fj.id AS failed_job_id,
    fj.uuid AS failed_uuid,
    fj.connection AS failed_connection,
    fj.queue AS failed_queue,
    fj.payload AS failed_payload,
    fj.exception AS failed_exception,
    fj.failed_at AS failed_timestamp

FROM events e

LEFT JOIN users u 
    ON u.id = e.user_id::bigint

LEFT JOIN sessions s 
    ON s.user_id = u.id

LEFT JOIN activity_log al 
    ON al.causer_id = u.id 
   AND al.causer_type = 'App\\Models\\User'

LEFT JOIN model_has_permissions mhp 
    ON mhp.model_id = u.id
   AND mhp.model_type = 'App\\Models\\User'

LEFT JOIN permissions p 
    ON p.id = mhp.permission_id

LEFT JOIN role_has_permissions rhp 
    ON rhp.permission_id = p.id

LEFT JOIN jobs j 
    ON j.id IS NOT NULL 

LEFT JOIN failed_jobs fj 
    ON fj.queue = j.queue

WHERE e.event_name = 'kur_page_slide';


# VIEW TABLE FOR KUR_BUTTON_SHOW (65 kolom)

CREATE OR REPLACE VIEW v_kur_button_show AS
SELECT
    e.id AS event_id,
    e.user_id::bigint AS user_id,
    e.event_name,

    e.event_properties->>'page_marker' AS page_marker,
    e.event_properties->>'previous_page_marker' AS previous_page_marker,
    e.event_properties->>'pre_previous_marker' AS pre_previous_marker,
    e.event_properties->>'page_name' AS page_name,
    e.event_properties->>'entry_source' AS entry_source,
    e.event_properties->>'previous_page_name' AS previous_page_name,
    e.event_properties->>'entry_method' AS entry_method,
    e.event_properties->>'area_page' AS area_page,

    u.name AS user_name,
    u.email AS user_email,
    u.email_verified_at,
	u.password,
    u.password_changed_at,
    u.active AS user_active,
    u.last_login_at,
    u.last_login_ip,
    u.status AS user_status,
	u.remember_token,
    u.created_at AS user_created_at,
    u.updated_at AS user_updated_at,
	u.deleted_at AS user_deleted_at,

    s.id AS session_id,
    s.ip_address AS session_ip,
    s.user_agent AS session_user_agent,
    s.payload AS session_payload,
    s.last_activity AS session_last_activity,

    al.id AS activity_id,
    al.log_name AS activity_log_name,
    al.description AS activity_description,
    al.subject_type,
    al.subject_id,
    al.causer_type,
    al.properties AS activity_properties,
    al.event AS activity_event,
    al.created_at AS activity_created_at,
    al.updated_at AS activity_updated_at,

    mhp.permission_id AS model_permission_id,
    mhp.model_type AS model_permission_type,

    p.name AS permission_name,
    p.guard_name,
    p.description AS permission_description,
    p.sort AS permission_sort,
    p.created_at AS permission_created_at,
    p.updated_at AS permission_updated_at,

    rhp.role_id AS role_id_linked,

    j.id AS job_id,
    j.queue AS job_queue,
    j.payload AS job_payload,
    j.attempts AS job_attempts,
    j.reserved_at,
    j.available_at,
    j.created_at AS job_created_at,

    fj.id AS failed_job_id,
    fj.uuid AS failed_uuid,
    fj.connection AS failed_connection,
    fj.queue AS failed_queue,
    fj.payload AS failed_payload,
    fj.exception AS failed_exception,
    fj.failed_at AS failed_timestamp

FROM events e

LEFT JOIN users u 
    ON u.id = e.user_id::bigint

LEFT JOIN sessions s 
    ON s.user_id = u.id

LEFT JOIN activity_log al 
    ON al.causer_id = u.id 
   AND al.causer_type = 'App\\Models\\User'

LEFT JOIN model_has_permissions mhp 
    ON mhp.model_id = u.id
   AND mhp.model_type = 'App\\Models\\User'

LEFT JOIN permissions p 
    ON p.id = mhp.permission_id

LEFT JOIN role_has_permissions rhp 
    ON rhp.permission_id = p.id

LEFT JOIN jobs j 
    ON j.id IS NOT NULL 

LEFT JOIN failed_jobs fj 
    ON fj.queue = j.queue

WHERE e.event_name = 'kur_button_show';


# VIEW TABLE FOR KUR_BUTTON_CLICK (--- kolom)

CREATE OR REPLACE VIEW v_kur_button_click AS
SELECT
    e.id AS event_id,
    e.user_id::bigint AS user_id,
    e.event_name,

    e.event_properties ->> 'button_marker'::text AS button_marker,
    e.event_properties ->> 'button_name'::text AS button_name,
    e.event_properties ->> 'previous_page_marker'::text AS previous_page_marker,
    e.event_properties ->> 'pre_previous_marker'::text AS pre_previous_marker,
    e.event_properties ->> 'entry_source'::text AS entry_source,
    e.event_properties ->> 'previous_page_name'::text AS previous_page_name,
    e.event_properties ->> 'entry_method'::text AS entry_method,
    e.event_properties ->> 'area_page'::text AS area_page,



    u.name AS user_name,
    u.email AS user_email,
    u.email_verified_at,
	u.password,
    u.password_changed_at,
    u.active AS user_active,
    u.last_login_at,
    u.last_login_ip,
    u.status AS user_status,
	u.remember_token,
    u.created_at AS user_created_at,
    u.updated_at AS user_updated_at,
	u.deleted_at AS user_deleted_at,

    s.id AS session_id,
    s.ip_address AS session_ip,
    s.user_agent AS session_user_agent,
    s.payload AS session_payload,
    s.last_activity AS session_last_activity,

    al.id AS activity_id,
    al.log_name AS activity_log_name,
    al.description AS activity_description,
    al.subject_type,
    al.subject_id,
    al.causer_type,
    al.properties AS activity_properties,
    al.event AS activity_event,
    al.created_at AS activity_created_at,
    al.updated_at AS activity_updated_at,

    mhp.permission_id AS model_permission_id,
    mhp.model_type AS model_permission_type,

    p.name AS permission_name,
    p.guard_name,
    p.description AS permission_description,
    p.sort AS permission_sort,
    p.created_at AS permission_created_at,
    p.updated_at AS permission_updated_at,

    rhp.role_id AS role_id_linked,

    j.id AS job_id,
    j.queue AS job_queue,
    j.payload AS job_payload,
    j.attempts AS job_attempts,
    j.reserved_at,
    j.available_at,
    j.created_at AS job_created_at,

    fj.id AS failed_job_id,
    fj.uuid AS failed_uuid,
    fj.connection AS failed_connection,
    fj.queue AS failed_queue,
    fj.payload AS failed_payload,
    fj.exception AS failed_exception,
    fj.failed_at AS failed_timestamp

FROM events e

LEFT JOIN users u 
    ON u.id = e.user_id::bigint

LEFT JOIN sessions s 
    ON s.user_id = u.id

LEFT JOIN activity_log al 
    ON al.causer_id = u.id 
   AND al.causer_type = 'App\\Models\\User'

LEFT JOIN model_has_permissions mhp 
    ON mhp.model_id = u.id
   AND mhp.model_type = 'App\\Models\\User'

LEFT JOIN permissions p 
    ON p.id = mhp.permission_id

LEFT JOIN role_has_permissions rhp 
    ON rhp.permission_id = p.id

LEFT JOIN jobs j 
    ON j.id IS NOT NULL 

LEFT JOIN failed_jobs fj 
    ON fj.queue = j.queue

WHERE e.event_name = 'kur_button_click';

# VIEW TABLE FOR CONFIRM RESULT (--- kolom)

CREATE OR REPLACE VIEW v_kur_confirm_result AS
SELECT
    e.id AS event_id,
    e.user_id::bigint AS user_id,
    e.event_name,

    e.event_properties ->> 'page_marker'::text AS page_marker,
    e.event_properties ->> 'previous_page_marker'::text AS previous_page_marker,
    e.event_properties ->> 'pre_previous_marker'::text AS pre_previous_marker,
    e.event_properties ->> 'page_name'::text AS page_name,
    e.event_properties ->> 'previous_page_name'::text AS previous_page_name,
    e.event_properties ->> 'entry_source'::text AS entry_source,
    e.event_properties ->> 'entry_method'::text AS entry_method,
    e.event_properties ->> 'page_area'::text AS page_area,
    e.event_properties ->> 'button_name'::text AS button_name,
    e.event_properties ->> 'value'::text AS value,


    u.name AS user_name,
    u.email AS user_email,
    u.email_verified_at,
	u.password,
    u.password_changed_at,
    u.active AS user_active,
    u.last_login_at,
    u.last_login_ip,
    u.status AS user_status,
	u.remember_token,
    u.created_at AS user_created_at,
    u.updated_at AS user_updated_at,
	u.deleted_at AS user_deleted_at,

    s.id AS session_id,
    s.ip_address AS session_ip,
    s.user_agent AS session_user_agent,
    s.payload AS session_payload,
    s.last_activity AS session_last_activity,

    al.id AS activity_id,
    al.log_name AS activity_log_name,
    al.description AS activity_description,
    al.subject_type,
    al.subject_id,
    al.causer_type,
    al.properties AS activity_properties,
    al.event AS activity_event,
    al.created_at AS activity_created_at,
    al.updated_at AS activity_updated_at,

    mhp.permission_id AS model_permission_id,
    mhp.model_type AS model_permission_type,

    p.name AS permission_name,
    p.guard_name,
    p.description AS permission_description,
    p.sort AS permission_sort,
    p.created_at AS permission_created_at,
    p.updated_at AS permission_updated_at,

    rhp.role_id AS role_id_linked,

    j.id AS job_id,
    j.queue AS job_queue,
    j.payload AS job_payload,
    j.attempts AS job_attempts,
    j.reserved_at,
    j.available_at,
    j.created_at AS job_created_at,

    fj.id AS failed_job_id,
    fj.uuid AS failed_uuid,
    fj.connection AS failed_connection,
    fj.queue AS failed_queue,
    fj.payload AS failed_payload,
    fj.exception AS failed_exception,
    fj.failed_at AS failed_timestamp

FROM events e

LEFT JOIN users u 
    ON u.id = e.user_id::bigint

LEFT JOIN sessions s 
    ON s.user_id = u.id

LEFT JOIN activity_log al 
    ON al.causer_id = u.id 
   AND al.causer_type = 'App\\Models\\User'

LEFT JOIN model_has_permissions mhp 
    ON mhp.model_id = u.id
   AND mhp.model_type = 'App\\Models\\User'

LEFT JOIN permissions p 
    ON p.id = mhp.permission_id

LEFT JOIN role_has_permissions rhp 
    ON rhp.permission_id = p.id

LEFT JOIN jobs j 
    ON j.id IS NOT NULL 

LEFT JOIN failed_jobs fj 
    ON fj.queue = j.queue

WHERE e.event_name = 'confirm_result';


# VIEW TABLE FOR CONFIRM VALUE (--- kolom)

CREATE OR REPLACE VIEW v_kur_confirm_result AS
SELECT
    e.id AS event_id,
    e.user_id::bigint AS user_id,
    e.event_name,

    e.event_properties ->> 'page_marker'::text AS page_marker,
    e.event_properties ->> 'previous_page_marker'::text AS previous_page_marker,
    e.event_properties ->> 'pre_previous_marker'::text AS pre_previous_marker,
    e.event_properties ->> 'page_name'::text AS page_name,
    e.event_properties ->> 'previous_page_name'::text AS previous_page_name,
    e.event_properties ->> 'entry_source'::text AS entry_source,
    e.event_properties ->> 'entry_method'::text AS entry_method,
    e.event_properties ->> 'page_area'::text AS page_area,
    e.event_properties ->> 'button_name'::text AS button_name,
    e.event_properties ->> 'value'::text AS value,


    u.name AS user_name,
    u.email AS user_email,
    u.email_verified_at,
	u.password,
    u.password_changed_at,
    u.active AS user_active,
    u.last_login_at,
    u.last_login_ip,
    u.status AS user_status,
	u.remember_token,
    u.created_at AS user_created_at,
    u.updated_at AS user_updated_at,
	u.deleted_at AS user_deleted_at,

    s.id AS session_id,
    s.ip_address AS session_ip,
    s.user_agent AS session_user_agent,
    s.payload AS session_payload,
    s.last_activity AS session_last_activity,

    al.id AS activity_id,
    al.log_name AS activity_log_name,
    al.description AS activity_description,
    al.subject_type,
    al.subject_id,
    al.causer_type,
    al.properties AS activity_properties,
    al.event AS activity_event,
    al.created_at AS activity_created_at,
    al.updated_at AS activity_updated_at,

    mhp.permission_id AS model_permission_id,
    mhp.model_type AS model_permission_type,

    p.name AS permission_name,
    p.guard_name,
    p.description AS permission_description,
    p.sort AS permission_sort,
    p.created_at AS permission_created_at,
    p.updated_at AS permission_updated_at,

    rhp.role_id AS role_id_linked,

    j.id AS job_id,
    j.queue AS job_queue,
    j.payload AS job_payload,
    j.attempts AS job_attempts,
    j.reserved_at,
    j.available_at,
    j.created_at AS job_created_at,

    fj.id AS failed_job_id,
    fj.uuid AS failed_uuid,
    fj.connection AS failed_connection,
    fj.queue AS failed_queue,
    fj.payload AS failed_payload,
    fj.exception AS failed_exception,
    fj.failed_at AS failed_timestamp

FROM events e

LEFT JOIN users u 
    ON u.id = e.user_id::bigint

LEFT JOIN sessions s 
    ON s.user_id = u.id

LEFT JOIN activity_log al 
    ON al.causer_id = u.id 
   AND al.causer_type = 'App\\Models\\User'

LEFT JOIN model_has_permissions mhp 
    ON mhp.model_id = u.id
   AND mhp.model_type = 'App\\Models\\User'

LEFT JOIN permissions p 
    ON p.id = mhp.permission_id

LEFT JOIN role_has_permissions rhp 
    ON rhp.permission_id = p.id

LEFT JOIN jobs j 
    ON j.id IS NOT NULL 

LEFT JOIN failed_jobs fj 
    ON fj.queue = j.queue

WHERE e.event_name = 'confirm_value';


