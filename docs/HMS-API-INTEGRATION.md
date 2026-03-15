# Lab API – Integration Guide for HMS (Hospital Management System)

Use this document to integrate your HMS with the Lab software’s API for creating **patients** and **test orders** (patient + tests).

---

## 1. Base URL & auth

- **Base URL:** `{LAB_APP_URL}/api`  
  Example: `https://your-lab-domain.com/api` or `http://localhost/api` for local.
- **Auth:** Token-based (Laravel Sanctum).  
  Endpoints that require auth: `POST /api/sync`. Open (no auth): register, login, and **`GET /api/tests`**.

---

## 2. Authentication

### 2.1 Register (one-time / optional)

Create an API user for the HMS.

- **Endpoint:** `POST /api/register`
- **Headers:** `Content-Type: application/json`
- **Body:**

```json
{
  "name": "HMS Integration",
  "email": "hms@yourhospital.com",
  "password": "your-secure-password",
  "password_confirmation": "your-secure-password"
}
```

- **Success (201):**

```json
{
  "user": { "id": 1, "name": "HMS Integration", "email": "hms@yourhospital.com" },
  "token": "1|abc123..."
}
```

- **Use:** Store `token` and send it in `Authorization: Bearer {token}` for all other requests.

### 2.2 Login

Get a token for an existing user.

- **Endpoint:** `POST /api/login`
- **Headers:** `Content-Type: application/json`
- **Body:**

```json
{
  "email": "hms@yourhospital.com",
  "password": "your-secure-password"
}
```

- **Success (200):** Same shape as register (user + token).
- **Error (422):** Invalid credentials.

---

## 3. List tests (open, no auth)

Get the list of all tests available in the Lab (id, code, short_hand). Use this to know valid test codes for the sync endpoint. **No authentication required.**

- **Endpoint:** `GET /api/tests`
- **Headers:** None required (no auth).

**Success (200):**

```json
{
  "data": [
    { "id": 1, "code": "CBC", "short_hand": "CBC" },
    { "id": 2, "code": "RBS", "short_hand": "RBS" },
    { "id": 3, "code": "LFT", "short_hand": "LFT" }
  ]
}
```

- **Fields:** `id` (Lab test id), `code` (use in `test_codes` for sync), `short_hand` (display name / shorthand).

---

## 4. Create patient + test order (sync)

Single endpoint to ensure a **patient** exists and to create a **test order** (link patient to tests by receipt number).

- **Endpoint:** `POST /api/sync`
- **Headers:**
  - `Content-Type: application/json`
  - `Authorization: Bearer {your_token}`
- **Body:**

| Field         | Type   | Required | Description |
|---------------|--------|----------|-------------|
| `name`        | string | Yes      | Patient full name (max 255) |
| `phone`       | string | Yes      | Phone number (max 20). Spaces/dashes are stripped. |
| `receipt_no`  | string | Yes      | Your HMS receipt/order number (max 100). Unique per order. |
| `test_codes`  | array  | Yes      | List of test codes (strings). Must match codes in Lab. At least one. |
| `age`         | number | No       | Patient age |
| `age_unit`    | string | No       | `"Month"` or `"Year"` (default: `"Year"`) |
| `gender`      | string | No       | `"male"` or `"female"` (default: `"male"`) |
| `doctor`      | string | No       | Referring doctor name (max 255). Default: `"Self"` |

**Example request:**

```json
{
  "name": "John Doe",
  "phone": "9876543210",
  "receipt_no": "HMS-ORD-2025-001",
  "test_codes": ["CBC", "RBS", "LFT"],
  "age": 35,
  "age_unit": "Year",
  "gender": "male",
  "doctor": "Dr. Smith"
}
```

### 4.1 Success responses

**New order created (201):**

```json
{
  "patient_id": 42,
  "receipt_no": "HMS-ORD-2025-001",
  "patient_tests": [
    { "id": 101, "test_id": 1, "test_code": "CBC" },
    { "id": 102, "test_id": 2, "test_code": "RBS" },
    { "id": 103, "test_id": 3, "test_code": "LFT" }
  ]
}
```

**Order already exists (200):**  
Same JSON shape. Use this when the same `receipt_no` was already sent (idempotent).

### 4.2 Error responses

**Invalid test code(s) (422):**

```json
{
  "message": "One or more test codes are invalid.",
  "invalid_codes": ["XYZ", "INVALID"]
}
```

**Invalid/missing phone (422):**

```json
{
  "message": "Phone number is required and must be valid."
}
```

**Validation errors (422):**  
Standard Laravel validation response with `message` and `errors` (field-wise).

**Unauthenticated (401):**  
Missing or invalid token. Use login/register to get a valid token.

---

## 5. Instructions for HMS developer

1. **Obtain base URL and credentials**  
   Get from Lab admin: `APP_URL` (e.g. `https://lab.yourhospital.com`) and one API user (email + password).

2. **Authenticate once (or on expiry)**  
   Call `POST /api/login` with that user. Store the returned `token`.  
   Use it in every request: `Authorization: Bearer <token>`.

3. **Know valid test codes**  
   Test codes (e.g. `CBC`, `RBS`, `LFT`) must **exactly match** the codes configured in the Lab.  
   - Call **`GET /api/tests`** (no auth) to get the full list: `id`, `code`, and `short_hand` for each test. Use `code` in `test_codes` when calling sync.  
   - Or: maintain a mapping in HMS (Lab test code ↔ your internal test/id).

4. **Sending an order**  
   When a patient is registered and tests are ordered in HMS:
   - Call `POST /api/sync` with:
     - Patient: `name`, `phone`, optional `age`, `age_unit`, `gender`, `doctor`.
     - Order: `receipt_no` (your unique receipt/order number), `test_codes` (array of Lab test codes).
   - If you get **201** or **200**, store in HMS:
     - `patient_id` (Lab’s patient id),
     - `receipt_no`,
     - `patient_tests[].id` (Lab’s order/test record id) and `test_code` if you need to track per test.

5. **Idempotency**  
   Sending the same `receipt_no` again for the same patient returns **200** and the same order; no duplicate orders are created.

6. **Phone format**  
   Lab normalizes phone by removing spaces and dashes. Send a consistent format from HMS (e.g. digits only).

7. **Patient matching**  
   Lab finds a patient by **name + phone**. If found, that patient is reused; otherwise a new one is created. So use the same name and phone for the same patient across orders.

---

## 6. Quick reference

| Action              | Method | Endpoint           | Auth  |
|---------------------|--------|--------------------|-------|
| Register API user   | POST   | `/api/register`    | No    |
| Login               | POST   | `/api/login`       | No    |
| List tests          | GET    | `/api/tests`       | No    |
| Create patient + order | POST | `/api/sync`        | Bearer token |

---

## 7. Contact

For base URL, test code list, or API user creation, contact the Lab system administrator.
