<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
#  Pet Management

## Sinh viên
- **Họ tên:** Nguyễn Mai Anh  
- **Mã sinh viên:** 23010490  

---

## Mô tả Dự án
Ứng dụng web **Pet Management** giúp quản lý thú cưng và thông tin khách hàng, đồng thời theo dõi việc nuôi dưỡng thú cưng bởi từng khách hàng. Dự án được xây dựng bằng **Laravel Framework**, sử dụng **Laravel Breeze** cho xác thực người dùng...

---

## Các đối tượng chính

1. **User**  
   - Xác thực người dùng (Laravel Breeze)

2. **Owner**  
   - Lưu thông tin khách hàng: tên, email, số điện thoại

3. **Pet**  
   - Lưu thông tin thú cưng: tên, loài, tuổi, mô tả

4. **PetOwner** (bảng `pet_owners`)  
   - Thể hiện mối quan hệ giữa **Owner** và **Pet**  
   - Là model đại diện cho **Pet Owner** trong hệ thống  

## Chức năng chính
- Đăng nhập / đăng ký người dùng
- Quản lý danh sách thú cưng (CRUD)
- Gán thú cưng cho khách hàng (Pet-Customer)
- Thống kê thú cưng được nuôi nhiều nhất
- Hiển thị danh sách thú cưng theo từng khách hàng
---

## Bảo mật (Security)
- Data Validation  
- Authentication & Authorization (Laravel Breeze)  
- Session & Cookies management 

---

## Cấu trúc hệ thống (Class Diagram)
![Sơ đồ lớp hệ thống quản lý thú cưng](cd.jpg)


## Code minh họa phần chính

###  Model: `Pet.php`

class Pet extends Model {
    protected $fillable = ['id', 'name', 'type', 'age'];

    public function owners() {
        return $this->belongsToMany(Owner::class, 'pet_owners');
    }
}
###  Model: Owner.php

class Owner extends Model {
    protected $fillable = ['id', 'name', 'email', 'phone'];

    public function pets() {
        return $this->belongsToMany(Pet::class, 'pet_owners');
    }
}
###  Model: PetOwner.php

class PetOwner extends Model {
    protected $table = 'pet_owners';

    public function pet() {
        return $this->belongsTo(Pet::class);
    }

    public function owner() {
        return $this->belongsTo(Owner::class);
    }
}
### Controller: PetOwnerController.php (Gán thú cưng cho khách)

public function assignPetToOwner(Request $request) {
    $request->validate([
        'pet_id' => 'required|exists:pets,id',
        'owner_id' => 'required|exists:owners,id',
    ]);

    $owner = Owner::find($request->owner_id);
    $owner->pets()->attach($request->pet_id);

    return back()->with('success', 'Đã gán thú cưng thành công!');
}
