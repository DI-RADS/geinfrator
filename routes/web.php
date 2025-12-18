<?php

use App\Http\Controllers\CourseBatchController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseStatusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatusController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

// Página inicial do site
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tela de login
Route::get('/login', [AuthController::class, 'index'])->name('login');

// Processar os dados do login
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Formulário cadastrar novo usuário
Route::get('/register', [AuthController::class, 'create'])->name('register');

// Receber os dados do formulário e cadastrar novo usuário
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

// Solicitar link para resetar senha
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Formulário para redefinir a senha com o token
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showRequestForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

// Grupo de rotas restritas
Route::group(['middleware' => 'auth'], function () {
    // Página inicial do administrativo
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('permission:dashboard');

    // GESTÃO DO PRODUTO
    Route::prefix('produto')->group(function () {
        Route::get('/', [ProdutoController::class, 'index'])->name('produtos.index')->middleware('permission:index-produtos');
        Route::get('/create', [ProdutoController::class, 'create'])->name('produto.create')->middleware('permission:create-produto');
        Route::get('/{produto}', [ProdutoController::class, 'show'])->name('produto.show')->middleware('permission:show-produto');
        Route::post('/', [ProdutoController::class, 'store'])->name('produto.store')->middleware('permission:create-produto');
        Route::get('/{produto}/edit', [ProdutoController::class, 'edit'])->name('produto.edit')->middleware('permission:edit-produto');
        Route::put('/{produto}', [ProdutoController::class, 'update'])->name('produto.update')->middleware('permission:edit-produto');
        Route::delete('/{produto}', [ProdutoController::class, 'destroy'])->name('produto.destroy')->middleware('permission:destroy-produto');

        Route::get('/pdf-show-produto/{produto}', [ProdutoController::class, 'showPdfProduto'])->name('produtos.pdf-show-produto')->middleware('permission:pdf-show-produto');
        Route::get('/pdf-index-produtos/produtos', [ProdutoController::class, 'pdfIndexProdutos'])->name('produtos.pdf-index-produtos')->middleware('permission:pdf-index-produtos');

        Route::get('/csv-index/produtos', [ProdutoController::class, 'csvIndexprodutos'])->name('produtos.csv-index-produtos')->middleware('permission:csv-index-produtos');
    });

    // ===================== GESTÃO DE CLIENTES =====================
    Route::prefix('cliente')->group(function () {
        Route::get('/', [ClienteController::class, 'index'])->name('cliente.index')->middleware('permission:index-cliente');
        Route::get('/create', [ClienteController::class, 'create'])
            ->name('cliente.create')->middleware('permission:create-cliente');
        Route::post('/', [ClienteController::class, 'store'])
            ->name('cliente.store')->middleware('permission:create-cliente');
        Route::get('/{cliente}', [ClienteController::class, 'show'])
            ->name('cliente.show')->middleware('permission:show-cliente');
        Route::get('/{cliente}/edit', [ClienteController::class, 'edit'])
            ->name('cliente.edit')->middleware('permission:edit-cliente');
        Route::put('/{cliente}', [ClienteController::class, 'update'])
            ->name('cliente.update')->middleware('permission:edit-cliente');
        Route::delete('/{cliente}', [ClienteController::class, 'destroy'])
            ->name('cliente.destroy')->middleware('permission:destroy-cliente');
    });

    // ===================== GESTÃO DE VENDAS =====================
    Route::prefix('venda')->group(function () {
        Route::get('/', [VendaController::class, 'index'])
            ->name('venda.index')->middleware('permission:index-venda');
        Route::get('/create', [VendaController::class, 'create'])
            ->name('venda.create')->middleware('permission:create-venda');
        Route::post('/', [VendaController::class, 'store'])
            ->name('venda.store')->middleware('permission:create-venda');
        Route::get('/{venda}', [VendaController::class, 'show'])
            ->name('venda.show')->middleware('permission:show-venda');
        Route::get('/{venda}/edit', [VendaController::class, 'edit'])
            ->name('venda.edit')->middleware('permission:edit-venda');
        Route::put('/{venda}', [VendaController::class, 'update'])
            ->name('venda.update')->middleware('permission:edit-venda');
        Route::delete('/{venda}', [VendaController::class, 'destroy'])
            ->name('venda.destroy')->middleware('permission:destroy-venda');
    });

    // ===================== GESTÃO FINANCEIRA =====================
    Route::prefix('financeiro')->group(function () {
        Route::get('/', [FinanceiroController::class, 'index'])
            ->name('financeiro.index')->middleware('permission:index-financeiro');
        Route::get('/create', [FinanceiroController::class, 'create'])
            ->name('financeiro.create')->middleware('permission:create-financeiro');
        Route::post('/', [FinanceiroController::class, 'store'])
            ->name('financeiro.store')->middleware('permission:create-financeiro');
        Route::get('/{financeiro}', [FinanceiroController::class, 'show'])
            ->name('financeiro.show')->middleware('permission:show-financeiro');
        Route::get('/{financeiro}/edit', [FinanceiroController::class, 'edit'])
            ->name('financeiro.edit')->middleware('permission:edit-financeiro');
        Route::put('/{financeiro}', [FinanceiroController::class, 'update'])
            ->name('financeiro.update')->middleware('permission:edit-financeiro');
        Route::delete('/{financeiro}', [FinanceiroController::class, 'destroy'])
            ->name('financeiro.destroy')->middleware('permission:destroy-financeiro');
    });

    // ===================== GESTÃO DE MARKETING =====================
    Route::prefix('marketing')->group(function () {
        Route::get('/', [MarketingController::class, 'index'])
            ->name('marketing.index')->middleware('permission:index-marketing');
        Route::get('/create', [MarketingController::class, 'create'])
            ->name('marketing.create')->middleware('permission:create-marketing');
        Route::post('/', [MarketingController::class, 'store'])
            ->name('marketing.store')->middleware('permission:create-marketing');
        Route::get('/{marketing}', [MarketingController::class, 'show'])
            ->name('marketing.show')->middleware('permission:show-marketing');
        Route::get('/{marketing}/edit', [MarketingController::class, 'edit'])
            ->name('marketing.edit')->middleware('permission:edit-marketing');
        Route::put('/{marketing}', [MarketingController::class, 'update'])
            ->name('marketing.update')->middleware('permission:edit-marketing');
        Route::delete('/{marketing}', [MarketingController::class, 'destroy'])
            ->name('marketing.destroy')->middleware('permission:destroy-marketing');
    });























    // Perfil
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show')->middleware('permission:show-profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('permission:edit-profile');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update')->middleware('permission:edit-profile');
        Route::get('/edit-password', [ProfileController::class, 'editPassword'])->name('profile.edit_password')->middleware('permission:edit-password-profile');
        Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update_password')->middleware('permission:edit-password-profile');
    });

    // Usuários
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('permission:index-user');
        Route::get('/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:create-user');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:show-user');
        Route::post('/', [UserController::class, 'store'])->name('users.store')->middleware('permission:create-user');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:edit-user');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:edit-user');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:destroy-user');

        Route::get('/{user}/edit-password', [UserController::class, 'editPassword'])->name('users.edit_password')->middleware('permission:edit-password-user');
        Route::put('/{user}/update-password', [UserController::class, 'updatePassword'])->name('users.update_password')->middleware('permission:edit-password-user');

        Route::get('/generate-pdf-user/{user}', [UserController::class, 'generatePdfUser'])->name('users.generate-pdf-user')->middleware('permission:generate-pdf-user');
        Route::get('/generate-pdf/users', [UserController::class, 'generatePdfUsers'])->name('users.generate-pdf-users')->middleware('permission:generate-pdf-users');

        Route::get('/generate-csv/users', [UserController::class, 'generateCSVUsers'])->name('users.generate-csv-users')->middleware('permission:generate-csv-users');
    });

    // Usuários Status
    Route::prefix('user-statuses')->group(function () {
        Route::get('/', [UserStatusController::class, 'index'])->name('user_statuses.index')->middleware('permission:index-user-status');
        Route::get('/create', [UserStatusController::class, 'create'])->name('user_statuses.create')->middleware('permission:create-user-status');
        Route::get('/{userStatus}', [UserStatusController::class, 'show'])->name('user_statuses.show')->middleware('permission:show-user-status');
        Route::post('/', [UserStatusController::class, 'store'])->name('user_statuses.store')->middleware('permission:create-user-status');
        Route::get('/{userStatus}/edit', [UserStatusController::class, 'edit'])->name('user_statuses.edit')->middleware('permission:edit-user-status');
        Route::put('/{userStatus}', [UserStatusController::class, 'update'])->name('user_statuses.update')->middleware('permission:edit-user-status');
        Route::delete('/{userStatus}', [UserStatusController::class, 'destroy'])->name('user_statuses.destroy')->middleware('permission:destroy-user-status');
    });

    // Papéis
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:index-role');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:create-role');
        Route::get('/{role}', [RoleController::class, 'show'])->name('roles.show')->middleware('permission:show-role');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:create-role');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:edit-role');
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:edit-role');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:destroy-role');
    });

    // Permissão do papel
    Route::prefix('role-permissions')->group(function () {
        Route::get('/{role}', [RolePermissionController::class, 'index'])->name('role-permissions.index')->middleware('permission:index-role-permission');
        Route::get('/{role}/{permission}', [RolePermissionController::class, 'update'])->name('role-permissions.update')->middleware('permission:update-role-permission');
    });

    // Permissão
    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:index-permission');
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:create-permission');
        Route::get('/{permission}', [PermissionController::class, 'show'])->name('permissions.show')->middleware('permission:show-permission');
        Route::post('/', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:create-permission');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:edit-permission');
        Route::put('/{permission}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:edit-permission');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:destroy-permission');
    });

    // Cursos
    Route::prefix('courses')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('courses.index')->middleware('permission:index-course');
        Route::get('/create', [CourseController::class, 'create'])->name('courses.create')->middleware('permission:create-course');
        Route::get('/{course}', [CourseController::class, 'show'])->name('courses.show')->middleware('permission:show-course');
        Route::post('/', [CourseController::class, 'store'])->name('courses.store')->middleware('permission:create-course');
        Route::get('/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit')->middleware('permission:edit-course');
        Route::put('/{course}', [CourseController::class, 'update'])->name('courses.update')->middleware('permission:edit-course');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('courses.destroy')->middleware('permission:destroy-course');
    });

    // Cursos Status
    Route::prefix('course-statuses')->group(function () {
        Route::get('/', [CourseStatusController::class, 'index'])->name('course_statuses.index')->middleware('permission:index-course-status');
        Route::get('/create', [CourseStatusController::class, 'create'])->name('course_statuses.create')->middleware('permission:create-course-status');
        Route::get('/{courseStatus}', [CourseStatusController::class, 'show'])->name('course_statuses.show')->middleware('permission:show-course-status');
        Route::post('/', [CourseStatusController::class, 'store'])->name('course_statuses.store')->middleware('permission:create-course-status');
        Route::get('/{courseStatus}/edit', [CourseStatusController::class, 'edit'])->name('course_statuses.edit')->middleware('permission:edit-course-status');
        Route::put('/{courseStatus}', [CourseStatusController::class, 'update'])->name('course_statuses.update')->middleware('permission:edit-course-status');
        Route::delete('/{courseStatus}', [CourseStatusController::class, 'destroy'])->name('course_statuses.destroy')->middleware('permission:destroy-course-status');
    });

    // Turmas
    Route::prefix('course-batches')->group(function () {
        Route::get('/courses/{course}', [CourseBatchController::class, 'index'])->name('course_batches.index')->middleware('permission:index-course-batch');
        Route::get('/create/{course}', [CourseBatchController::class, 'create'])->name('course_batches.create')->middleware('permission:create-course-batch');
        Route::get('/{courseBatch}', [CourseBatchController::class, 'show'])->name('course_batches.show')->middleware('permission:show-course-batch');
        Route::post('/{course}', [CourseBatchController::class, 'store'])->name('course_batches.store')->middleware('permission:create-course-batch');
        Route::get('/{courseBatch}/edit', [CourseBatchController::class, 'edit'])->name('course_batches.edit')->middleware('permission:edit-course-batch');
        Route::put('/{courseBatch}', [CourseBatchController::class, 'update'])->name('course_batches.update')->middleware('permission:edit-course-batch');
        Route::delete('/{courseBatch}', [CourseBatchController::class, 'destroy'])->name('course_batches.destroy')->middleware('permission:destroy-course-batch');
    });

    // Módulos
    Route::prefix('modules')->group(function () {
        Route::get('/course-batch/{courseBatch}', [ModuleController::class, 'index'])->name('modules.index')->middleware('permission:index-module');
        Route::get('/create/{courseBatch}', [ModuleController::class, 'create'])->name('modules.create')->middleware('permission:create-module');
        Route::get('/{module}', [ModuleController::class, 'show'])->name('modules.show')->middleware('permission:show-module');
        Route::post('/create/{courseBatch}', [ModuleController::class, 'store'])->name('modules.store')->middleware('permission:create-module');
        Route::get('/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit')->middleware('permission:edit-module');
        Route::put('/{module}', [ModuleController::class, 'update'])->name('modules.update')->middleware('permission:edit-module');
        Route::delete('/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy')->middleware('permission:destroy-module');
    });

    // Aulas
    Route::prefix('lessons')->group(function () {
        Route::get('/module/{module}', [LessonController::class, 'index'])->name('lessons.index')->middleware('permission:index-lesson');
        Route::get('/create/{module}', [LessonController::class, 'create'])->name('lessons.create')->middleware('permission:create-lesson');
        Route::get('/{lesson}', [LessonController::class, 'show'])->name('lessons.show')->middleware('permission:show-lesson');
        Route::post('/{module}', [LessonController::class, 'store'])->name('lessons.store')->middleware('permission:create-lesson');
        Route::get('/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit')->middleware('permission:edit-lesson');
        Route::put('/{lesson}', [LessonController::class, 'update'])->name('lessons.update')->middleware('permission:edit-lesson');
        Route::delete('/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy')->middleware('permission:destroy-lesson');
    });
});
