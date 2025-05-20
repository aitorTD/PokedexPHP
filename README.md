


          
# PokeDex

A PHP Laravel application that simulates a Pokémon database management system, allowing users to view, create, edit, and manage Pokémon information.

## Features

- **User Authentication System**
  - Login and registration functionality
  - User roles: Regular users and "Profesor Pokemon" (admin) roles
  - User profile management

- **Pokémon Management**
  - View a list of all Pokémon with pagination
  - Search Pokémon by name
  - Sort Pokémon in ascending or descending order
  - View detailed information about each Pokémon
  - Add new Pokémon (admin only)
  - Edit existing Pokémon (admin only)
  - Delete Pokémon (admin only)

- **Pokémon Details**
  - Name, ID, and image
  - Base stats (Attack, Defense, HP)
  - Pokémon types (up to two types per Pokémon)
  
- **User Features**
  - Set favorite Pokémon
  - View user profiles
  - Edit user information (name, email, password)
  - Admin can view and manage all users

## Requirements

- PHP 7.4 or higher
- Composer
- MySQL database
- Laravel 8.x
- Web server (Apache/Nginx)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/PokedexPHP.git
   cd PokedexPHP
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Set up environment file**
   ```bash
   cp .env.example .env
   ```

4. **Configure your database**
   
   Edit the `.env` file and update the database connection settings:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pokedex
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Create storage link for images**
   ```bash
   php artisan storage:link
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

9. **Access the application**
   
   Open your browser and navigate to `http://localhost:8000`

## Database Structure

The application uses several tables:
- `users` - Stores user information
- `pokemones` - Stores Pokémon data
- `tipos` - Stores Pokémon types
- `tipo_pokemon` - Junction table for Pokémon and their types
- `objetos` - Stores items that can be associated with Pokémon

## User Roles

- **Regular User**: Can view Pokémon, set favorite Pokémon, and edit their own profile
- **Profesor Pokemon**: Admin role with full access to create, edit, and delete Pokémon, as well as manage users

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software.

        