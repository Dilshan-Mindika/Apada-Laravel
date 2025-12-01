# Sri Lankan Flood-Relief Assistance Platform

A Laravel 11 + Vue 3 + Inertia.js application for flood relief assistance.

## Features
- **Landing Page**: Role selection (Victim/Donor).
- **Request Help**: Victims can submit requests with geolocation.
- **Donor Portal**: Donors can view, filter, accept, and complete requests.
- **Admin Panel**: Dashboard with statistics and request management.
- **Localization**: Full support for English, Sinhala, and Tamil.
- **Geolocation**: Integration with Google Maps.

## Installation

1.  **Clone the repository** (if not already done).
2.  **Install PHP dependencies**:
    ```bash
    composer install
    ```
3.  **Install Node dependencies**:
    ```bash
    npm install
    ```
4.  **Configure Environment**:
    - Copy `.env.example` to `.env` (already done).
    - Update DB credentials in `.env`.
5.  **Generate Key**:
    ```bash
    php artisan key:generate
    ```
6.  **Migrate and Seed**:
    ```bash
    php artisan migrate --seed
    ```
7.  **Build Assets**:
    ```bash
    npm run build
    ```
8.  **Run Server**:
    ```bash
    php artisan serve
    ```

## Usage
- **Home**: `http://localhost:8000` (Landing Page)
- **Request Help**: `http://localhost:8000/request-help`
- **Donor Portal**: `http://localhost:8000/donor/requests`
- **Admin Panel**: `http://localhost:8000/admin/dashboard`
