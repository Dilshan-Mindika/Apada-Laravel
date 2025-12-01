# Sri Lankan Flood-Relief Assistance Platform (Apada)

A comprehensive, localized, and mobile-responsive web application built with Laravel 11, Vue 3, and Inertia.js to facilitate flood relief assistance in Sri Lanka.

## 🚀 Tech Stack
-   **Framework**: Laravel 11
-   **Frontend**: Vue 3 (Composition API) + Inertia.js
-   **Styling**: Tailwind CSS
-   **Database**: MySQL
-   **Icons**: Heroicons

## ✨ Features

### 🌍 Public Features
-   **Multi-language Support**: Fully localized in English, Sinhala (සිංහල), and Tamil (தமிழ்).
-   **Dark Mode**: Seamless dark mode support across the entire application.
-   **Mobile Responsive**: Optimized for all devices.
-   **Emergency Hotlines**: Quick access to essential emergency contact numbers.

### 🆘 For Victims
-   **Request Help**: Submit relief requests with categories (Food, Water, Medicine, etc.) and GPS location.
-   **My Requests**: Track the status of submitted requests using a phone number.
-   **Verification**: Confirm receipt of aid to update request status.

### 🤝 For Donors
-   **Donor Portal**: View a list of all relief requests.
-   **Filtering**: Filter requests by category and search by keyword.
-   **Actions**:
    -   **Accept**: Mark a request as accepted.
    -   **Mark as Delivering**: Notify that aid is on the way.
    -   **Complete**: Mark the request as fulfilled.

### 🔍 Missing People Platform
-   **Report Missing**: Report missing persons with photos and details.
-   **Search**: Search for missing people by name.
-   **Status Updates**: Mark persons as "Found".

### 🛡️ Admin Panel
-   **Dashboard**: Real-time statistics on requests and missing people.
-   **Request Management**: Edit or delete relief requests.
-   **Missing People Management**: Edit or delete missing person records.
-   **User Management**: Create, view, edit, and delete system users (Admins).
-   **Secure Authentication**: Dedicated admin login.

## 🛠️ Installation

1.  **Clone the repository**:
    ```bash
    git clone <repository-url>
    cd Apada-Laravel
    ```

2.  **Install PHP dependencies**:
    ```bash
    composer install
    ```

3.  **Install Node dependencies**:
    ```bash
    npm install
    ```

4.  **Configure Environment**:
    -   Copy `.env.example` to `.env`:
        ```bash
        cp .env.example .env
        ```
    -   Update database credentials in `.env`.

5.  **Generate Application Key**:
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations and Seeders**:
    ```bash
    php artisan migrate --seed
    ```
    *Note: This will create a default admin user.*

7.  **Build Assets**:
    ```bash
    npm run build
    ```

8.  **Run Development Server**:
    ```bash
    php artisan serve
    ```

## 🔗 Usage

| Page | Route | Description |
| :--- | :--- | :--- |
| **Home** | `/` | Landing page with role selection. |
| **Request Help** | `/request-help` | Form to submit relief requests. |
| **My Requests** | `/my-requests` | Check status of submitted requests. |
| **Donor Portal** | `/donor/requests` | Browse and respond to requests. |
| **Missing People** | `/missing-people` | View and report missing persons. |
| **Admin Login** | `/admin/login` | Login for administrators. |
| **Admin Dashboard** | `/admin/dashboard` | Admin control panel. |

## 🔑 Default Admin Credentials
(If seeded)
-   **Email**: `admin@example.com`
-   **Password**: `password`

## 📄 License
The MIT License (MIT).
