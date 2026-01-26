const photoInput = document.getElementById('photoInput');
const uploadForm = document.getElementById('photoUploadForm');
const uploadProgress = document.getElementById('uploadProgress');
const progressBar = document.getElementById('progressBar');
const uploadMessage = document.getElementById('uploadMessage');
const uploadText = document.getElementById('uploadText');
// userId is set in the blade template before this script loads

let pendingDeleteForm = null;

// Toggle sidebar visibility
window.toggleSidebar = function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.toggle('sidebar-hidden');
    overlay.classList.toggle('hidden');
};

// Close sidebar when clicking a link (mobile only, auto close)
document.querySelectorAll('#sidebar a, #sidebar button').forEach(element => {
    element.addEventListener('click', () => {
        if (window.innerWidth < 1024) {
            document.getElementById('sidebar').classList.add('sidebar-hidden');
            document.getElementById('sidebarOverlay').classList.add('hidden');
        }
    });
});

// Handle window resize
window.addEventListener('resize', () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (window.innerWidth >= 1024) {
        sidebar.classList.remove('sidebar-hidden');
        overlay.classList.add('hidden');
    } else {
        sidebar.classList.add('sidebar-hidden');
        overlay.classList.add('hidden');
    }
});

// Initialize on page load
window.addEventListener('load', () => {
    const sidebar = document.getElementById('sidebar');
    if (window.innerWidth < 1024) {
        sidebar.classList.add('sidebar-hidden');
    }
});

// Photo input change event
photoInput.addEventListener('change', function() {
    if (this.files.length > 0) {
        uploadText.textContent = this.files[0].name;
        uploadPhoto(this.files[0]);
    }
});

// Upload photo via AJAX
function uploadPhoto(file) {
    const formData = new FormData();
    formData.append('photo', file);
    formData.append('_token', document.querySelector('input[name="_token"]').value);

    uploadProgress.classList.remove('hidden');
    uploadMessage.innerHTML = '';

    fetch(`/admin/panel/users/${userId}/photo/upload`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        uploadProgress.classList.add('hidden');
        if (data.success) {
            uploadMessage.innerHTML = '<span class="text-green-600 text-xs"><i class="fas fa-check-circle mr-1"></i>' + data.message + '</span>';
            photoInput.value = '';
            uploadText.textContent = 'Choose Photo';
            loadPhotos();
        } else {
            uploadMessage.innerHTML = '<span class="text-red-600 text-xs"><i class="fas fa-times-circle mr-1"></i>' + data.message + '</span>';
        }
    })
    .catch(error => {
        uploadProgress.classList.add('hidden');
        uploadMessage.innerHTML = '<span class="text-red-600 text-xs"><i class="fas fa-times-circle mr-1"></i>Upload failed</span>';
        console.error('Error:', error);
    });
}

// Load all photos
function loadPhotos() {
    fetch(`/admin/panel/users/${userId}/photos`)
        .then(response => response.json())
        .then(data => {
            const allPhotos = document.getElementById('allPhotos');
            const photoCount = document.getElementById('photoCount');
            photoCount.textContent = data.photos.length;
            
            if (data.photos.length === 0) {
                allPhotos.innerHTML = '<p class="text-gray-600 text-xs col-span-3">No photos yet</p>';
                return;
            }

            allPhotos.innerHTML = data.photos.map(photo => `
                <div class="relative group">
                    <img src="${photo.url}" alt="Photo" class="w-full aspect-square object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 rounded-lg transition flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100">
                        ${!photo.is_profile ? `<a href="/admin/panel/users/${userId}/photos/${photo.id}/set-profile" class="bg-white text-blue-600 p-1.5 rounded text-xs hover:bg-blue-50" title="Set as profile"><i class="fas fa-star"></i></a>` : '<span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-semibold">Profile</span>'}
                        <form method="POST" action="/admin/panel/users/${userId}/photos/${photo.id}" class="inline" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white p-1.5 rounded text-xs hover:bg-red-700" title="Delete" onclick="return confirm('Delete this photo?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    ${photo.is_profile ? '<span class="absolute top-1 right-1 bg-blue-500 text-white px-2 py-1 rounded text-xs font-semibold"><i class="fas fa-check"></i></span>' : ''}
                </div>
            `).join('');
        });
}

// Load photos on page load
loadPhotos();
