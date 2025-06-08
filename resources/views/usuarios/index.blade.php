@extends('dashboard')

@section('template_title', 'Panel de Gestión de Usuarios')

@section('crud_content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-lg">
        <!-- Card Header -->
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <i class="fas fa-users-cog fa-lg me-3"></i>
                <h5 class="mb-0 font-weight-bold text-white">Administración de Usuarios</h5>
            </div>
            <button class="btn btn-light rounded-pill" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-user-plus me-2"></i>Nuevo Usuario
            </button>
        </div>
        
        <!-- Card Body -->
        <div class="card-body p-0">
            <div class="table-responsive rounded-lg">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light-primary text-white">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Nombre Completo</th>
                            <th class="py-3">Correo Electrónico</th>
                            <th class="py-3">Teléfono</th>
                            <th class="py-3">Rol</th>
                            <th class="py-3 pe-4 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personas as $persona)
                        <tr class="border-bottom">
                            <td class="ps-4">{{ $persona->id_persona }}</td>
                            <td class="fw-semibold">{{ $persona->nom }} {{ $persona->ap }} {{ $persona->am }}</td>
                            <td>{{ $persona->correo }}</td>
                            <td>{{ $persona->telefono }}</td>
                            <td>
                                <span class="badge bg-{{ $persona->rol->nom_rol == 'Administrador' ? 'primary' : 'success' }} rounded-pill">
                                    {{ $persona->rol->nom_rol }}
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-info rounded-start-pill me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewUserModal{{ $persona->id_persona }}">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal{{ $persona->id_persona }}">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger rounded-end-pill" 
                                            onclick="confirmDelete('{{ route('usuarios.destroy', $persona->id_persona) }}', 'Usuario #{{ $persona->id_persona }}')">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modales para cada usuario -->
@foreach ($personas as $persona)
<!-- Modal Ver Usuario -->
<div class="modal fade" id="viewUserModal{{ $persona->id_persona }}" tabindex="-1" 
     aria-labelledby="viewUserLabel{{ $persona->id_persona }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-info-circle me-2 text-white"></i>Detalles de Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">ID:</h6>
                        <p class="fw-bold">{{ $persona->id_persona }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Fecha Registro:</h6>
                        <p class="fw-bold">{{ $persona->created_at?->format('d/m/Y') ?? 'Sin fecha' }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Nombre Completo:</h6>
                        <p class="fw-bold">{{ $persona->nom }} {{ $persona->ap }} {{ $persona->am }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Rol:</h6>
                        <p class="fw-bold">
                            <span class="badge bg-{{ $persona->rol->nom_rol == 'Administrador' ? 'primary' : 'success' }}">
                                {{ $persona->rol->nom_rol }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Correo Electrónico:</h6>
                        <p class="fw-bold">{{ $persona->correo }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Teléfono:</h6>
                        <p class="fw-bold">{{ $persona->telefono }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-pill" 
                        data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Usuario -->
<div class="modal fade" id="editUserModal{{ $persona->id_persona }}" tabindex="-1" 
     aria-labelledby="editUserLabel{{ $persona->id_persona }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-user-edit me-2 text-white"></i>Editar Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('usuarios.update', $persona->id_persona) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label text-muted">Nombre</label>
                        <input type="text" name="nom" class="form-control border-2" 
                               value="{{ old('nom', $persona->nom) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Apellido Paterno</label>
                        <input type="text" name="ap" class="form-control border-2" 
                               value="{{ old('ap', $persona->ap) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Apellido Materno</label>
                        <input type="text" name="am" class="form-control border-2" 
                               value="{{ old('am', $persona->am) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Correo Electrónico</label>
                        <input type="email" name="correo" class="form-control border-2" 
                               value="{{ old('correo', $persona->correo) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Teléfono</label>
                        <input type="text" name="telefono" class="form-control border-2" 
                               value="{{ old('telefono', $persona->telefono) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Rol</label>
                        <select name="id_rol" class="form-select border-2" required>
                            @foreach ($roles as $rol)
                            <option value="{{ $rol->id_rol }}" {{ $persona->id_rol == $rol->id_rol ? 'selected' : '' }}>
                                {{ $rol->nom_rol }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-save me-1"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Crear Usuario -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title text-white">
                    <i class="fas fa-user-plus me-2 text-white"></i>Nuevo Usuario
                </h5>
                <button type="button" class="btn-close btn-close-white" 
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('usuarios.store') }}" id="userCreateForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control border-2" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Apellido Paterno <span class="text-danger">*</span></label>
                            <input type="text" name="ap" class="form-control border-2" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">Apellido Materno</label>
                        <input type="text" name="am" class="form-control border-2">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control border-2" required>
                            <div class="invalid-feedback">Por favor ingrese un correo válido</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Teléfono <span class="text-danger">*</span></label>
                            <input type="text" name="telefono" class="form-control border-2" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Contraseña <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control border-2" required minlength="6">
                            <div class="invalid-feedback">La contraseña debe tener al menos 6 caracteres</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Confirmar Contraseña <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control border-2" required>
                            <div class="invalid-feedback">Las contraseñas no coinciden</div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Rol <span class="text-danger">*</span></label>
                            <select name="id_rol" id="rolSelect" class="form-select border-2" required>
                                @foreach ($roles as $rol)
                                <option value="{{ $rol->id_rol }}">{{ $rol->nom_rol }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3" id="cedulaField" style="display: none;">
                            <label class="form-label text-muted">Cédula Profesional</label>
                            <input type="text" name="cedula" class="form-control border-2">
                            <small class="text-muted">Solo para técnicos</small>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="button" class="btn btn-outline-secondary me-md-2 rounded-pill" 
                                data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts Mejorados -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
    const rolSelect = document.getElementById('rolSelect');
    const cedulaField = document.getElementById('cedulaField');
    
    // Mostrar campo cédula solo para técnicos
    rolSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex].text.toLowerCase();
        if(selectedOption.includes('tecnico')) {
            cedulaField.style.display = 'block';
            cedulaField.querySelector('input').setAttribute('required', 'required');
        } else {
            cedulaField.style.display = 'none';
            cedulaField.querySelector('input').removeAttribute('required');
        }
    });
    
    // Validación de contraseñas coincidentes
    const form = document.getElementById('userCreateForm');
    form.addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = form.querySelector('input[name="password_confirmation"]').value;
        
        if(password !== confirmPassword) {
            e.preventDefault();
            alert('Las contraseñas no coinciden');
        }
    });
    
    // Disparar el evento change al cargar para ver el estado inicial
    const event = new Event('change');
    rolSelect.dispatchEvent(event);
});
// Sistema de gestión de modales mejorado para Usuarios
document.addEventListener('DOMContentLoaded', function() {
    // 1. Inicialización controlada de modales
    const modalInstances = new Map();

    // Función para manejar la apertura de modales
    function handleModalOpen(e) {
        e.preventDefault();
        const modalId = this.getAttribute('data-bs-target');
        const modalElement = document.querySelector(modalId);
        
        if (!modalElement) return;
        
        // Cerrar modal actual si existe
        if (modalInstances.size > 0) {
            closeAllModals();
        }
        
        // Crear nueva instancia de modal
        const modalInstance = new bootstrap.Modal(modalElement, {
            backdrop: true,
            keyboard: true
        });
        
        // Configurar eventos para este modal
        modalElement.addEventListener('hidden.bs.modal', function() {
            cleanUpModal(modalId);
        });

        modalInstances.set(modalId, modalInstance);
        modalInstance.show();
    }
    
    // Función para limpiar después de cerrar un modal
    function cleanUpModal(modalId) {
        // Limpiar el backdrop manualmente si es necesario
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => {
            backdrop.parentNode.removeChild(backdrop);
        });
        
        // Restaurar el estado del body
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
        
        // Eliminar la instancia del modal
        modalInstances.delete(modalId);
    }
    
    // Función para cerrar todos los modales y limpiar
    function closeAllModals() {
        modalInstances.forEach((instance, modalId) => {
            instance.hide();
            cleanUpModal(modalId);
        });
        modalInstances.clear();
    }
    
    // Asignar eventos a los botones de apertura de modales
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(btn => {
        btn.addEventListener('click', handleModalOpen);
    });
    
    // 2. Función para eliminar usuario con confirmación
    window.confirmDelete = function(url, userName) {
        Swal.fire({
            title: '¿Confirmar eliminación?',
            html: `El usuario <strong>${userName}</strong> será eliminado permanentemente`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: 'rounded-3',
                confirmButton: 'btn btn-danger px-4 rounded-pill',
                cancelButton: 'btn btn-secondary px-4 rounded-pill ms-2'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                form.innerHTML = `@csrf @method("DELETE")`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    };
    
    // 3. Notificaciones automáticas mejoradas para usuarios
    @if(session('success'))
    showNotification('success', '{{ session('success') }}');
    @endif
    
    @if(session('error'))
    showNotification('error', '{{ session('error') }}');
    @endif
    
    @if(session('register'))
    showNotification('success', 'Usuario registrado correctamente');
    @endif
    
    @if(session('modify'))
    showNotification('success', 'Usuario actualizado correctamente');
    @endif
    
    @if(session('destroy'))
    showNotification('success', 'Usuario eliminado correctamente');
    @endif
    
    function showNotification(type, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: 'var(--bs-light)',
            color: 'var(--bs-dark)',
            iconColor: type === 'success' ? 'var(--bs-success)' : 'var(--bs-danger)',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
        
        Toast.fire({
            icon: type,
            title: message
        });
    }

    // 4. Manejo especial para botones de cierre dentro de modales
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.modal');
            if (modal) {
                const modalId = '#' + modal.id;
                const instance = modalInstances.get(modalId);
                if (instance) {
                    instance.hide();
                    cleanUpModal(modalId);
                }
            }
        });
    });

    // 5. Limpiar formularios al cerrar modales de creación/edición
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            const forms = this.querySelectorAll('form');
            forms.forEach(form => {
                form.reset();
                // Limpiar mensajes de error de validación
                const errorElements = form.querySelectorAll('.is-invalid, .invalid-feedback');
                errorElements.forEach(el => {
                    el.classList.remove('is-invalid', 'invalid-feedback');
                });
            });
        });
    });
});
</script>

<style>
    /* Estilos personalizados para esta vista */
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--wood-primary), var(--wood-primary-dark));
    }
    
    .bg-light-primary {
        background-color: rgba(69, 117, 63, 0.1);
    }
    
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(232, 245, 233, 0.5);
    }
    
    .form-control.border-2, .form-select.border-2 {
        border-width: 2px !important;
        border-radius: 8px;
    }
    
    /* Mejoras para los modales */
    .modal-content {
        border-radius: 12px;
        overflow: hidden;
    }
    
    .modal-header {
        padding: 1.25rem 1.5rem;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .modal-footer {
        padding: 1rem 1.5rem;
    }
</style>
@endsection