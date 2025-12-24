# Coding Convention - Project Manager

Mọi chức năng mới được thêm vào hệ thống phải tuân thủ nghiêm ngặt các quy tắc sau:

## 1. Cấu trúc Backend (SMVC)
- **Controller**: Chỉ làm nhiệm vụ điều hướng, nhận request, gọi Service. KHÔNG viết logic nghiệp vụ (business logic) tại đây. Sử dụng `ApiResponseTrait` để trả về response đồng nhất.
- **Request**: Mọi API request PHẢI sử dụng Form Request để validate dữ liệu đầu vào. KHÔNG validate trực tiếp trong Controller.
- **Service**: Nơi xử lý logic nghiệp vụ chính. Mọi Service PHẢI có Interface tương ứng để hỗ trợ Dependency Injection.
- **Repository**: Nơi thực hiện các truy vấn dữ liệu. Mọi Repository PHẢI kế thừa từ `BaseRepository` để tái sử dụng các hàm CRUD cơ bản và PHẢI có Interface tương ứng.
- **Model**: Chỉ chứa các khai báo về bảng, quan hệ (Relationships) và các xử lý dữ liệu đặc thù của model.
- **Constants**: Tất cả các giá trị cố định (Roles, Status, Type, Items per page, ...) PHẢI được định nghĩa trong `app/Constants`. KHÔNG sử dụng magic strings/numbers.
- **Traits**: Các xử lý dùng chung giữa các Class (như Response, Upload file) PHẢI được đưa vào `app/Traits`.
- **Helpers**: Các hàm tiện ích toàn cục PHẢI được định nghĩa trong `app/Helpers/FunctionHelper.php` và đăng ký trong `composer.json`.

## 2. Quy tắc đặt tên
- **Class/Service/Repository/Interface**: CamelCase (Ví dụ: `ProjectService`, `IProjectService`, `ProjectRepository`).
- **Function/Method**: camelCase (Ví dụ: `getProjectList`).
- **Variable**: camelCase.
- **Table/Database Column**: snake_case.

## 3. API Response
Mọi API phải trả về định dạng JSON thông qua `ApiResponseTrait`:
- Thành công: `{ "status": "success", "message": "...", "data": [...] }`
- Thất bại: `{ "status": "error", "message": "...", "data": null }`

---
*Lưu ý: Dev phải đọc file này trước khi thực hiện bất kỳ thay đổi nào về code.*