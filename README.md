# Media Library Application

This is a simple web application for managing a media library. Users can upload, view, and delete products (images) in the library.

## Features

- Upload multiple images at once
- Search for images by name or description
- Feedback during upload process with progress bar
- Responsive design for mobile and desktop

## Technologies Used

- Laravel (PHP framework)
- Tailwind CSS (for styling)
- JavaScript (for interactivity)

## Getting Started

1. Clone the repository: `git clone https://github.com/your-username/media-library.git`
2. Install dependencies: `composer install && npm install`
3. Configure your environment: Copy the `.env.example` file to `.env` and set up your environment variables, including database connection settings.
4. Generate application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Start the development server: `php artisan serve`
7. Visit `http://localhost:8000` in your web browser to view the application.

## Usage

- Visit the homepage to view the list of uploaded products.
- Click on "Upload a new product" to upload new images.
- Use the search bar to filter products by name or description.
- Click on the delete button to remove a product from the library.

## Contributing

Contributions are welcome! Please follow the [GitHub Flow](https://guides.github.com/introduction/flow/) when making contributions.

1. Fork the repository
2. Create a new branch: `git checkout -b feature-name`
3. Make your changes and commit them: `git commit -am 'Add new feature'`
4. Push to the branch: `git push origin feature-name`
5. Submit a pull request

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
