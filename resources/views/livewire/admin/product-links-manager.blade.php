<div class="product-links-manager">
    <div class="card">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 text-dark">
                <i class="fas fa-link me-2 text-primary"></i>
                روابط المنتج
            </h5>
            <small class="text-muted">أضف روابط مهمة متعلقة بالمنتج</small>
        </div>
        
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="links-container">
                @forelse($links as $index => $link)
                    <div class="link-item border rounded p-3 mb-3 bg-light" wire:key="link-{{ $index }}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-link me-1"></i>
                                        رابط #{{ $index + 1 }}
                                    </label>
                                    @if(count($links) > 1)
                                        <button 
                                            type="button" 
                                            class="btn btn-danger btn-sm"
                                            wire:click="removeLink({{ $index }})"
                                            title="حذف الرابط"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">
                                    الرابط (URL) <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-globe text-muted"></i>
                                    </span>
                                    <input 
                                        type="url"
                                        class="form-control @error('links.'.$index.'.url') is-invalid @enderror"
                                        wire:model.lazy="links.{{ $index }}.url"
                                        wire:blur="formatUrl({{ $index }})"
                                        placeholder="https://example.com"
                                        dir="ltr"
                                    >
                                </div>
                                @error('links.'.$index.'.url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">
                                    العنوان <span class="text-danger">*</span>
                                </label>
                                <input 
                                    type="text"
                                    class="form-control @error('links.'.$index.'.caption') is-invalid @enderror"
                                    wire:model="links.{{ $index }}.caption"
                                    placeholder="عنوان الرابط"
                                >
                                @error('links.'.$index.'.caption')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="form-label">الوصف</label>
                                <textarea 
                                    class="form-control @error('links.'.$index.'.description') is-invalid @enderror"
                                    wire:model="links.{{ $index }}.description"
                                    rows="2"
                                    placeholder="وصف اختياري للرابط"
                                ></textarea>
                                @error('links.'.$index.'.description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Link Preview -->
                        @if(!empty($link['url']) && !empty($link['caption']))
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="card border-info bg-light">
                                        <div class="card-body p-2">
                                            <h6 class="text-muted mb-1">
                                                <i class="fas fa-eye me-1"></i>
                                                معاينة الرابط
                                            </h6>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-external-link-alt text-info me-2"></i>
                                                <div>
                                                    <strong class="text-info">{{ $link['caption'] }}</strong>
                                                    @if(!empty($link['description']))
                                                        <p class="mb-0 small text-muted">{{ $link['description'] }}</p>
                                                    @endif
                                                    <small class="text-muted">{{ $link['url'] }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-link fa-3x mb-3 opacity-50"></i>
                        <p>لا توجد روابط مضافة</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-3">
                <button 
                    type="button" 
                    class="btn btn-outline-primary"
                    wire:click="addLink"
                >
                    <i class="fas fa-plus me-2"></i>
                    إضافة رابط جديد
                </button>
                
                <!-- Debug Button (Remove in production) -->
                <button 
                    type="button" 
                    class="btn btn-outline-info ms-2"
                    onclick="debugLinksData()"
                >
                    <i class="fas fa-bug me-2"></i>
                    تحقق من البيانات
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-format URLs as user types
    document.addEventListener('livewire:init', () => {
        Livewire.on('urlFormatted', (event) => {
            // Optional: Add any URL formatting logic here
        });
        
        // Listen for form submission preparation
        Livewire.on('links-validated', (linksData) => {
            console.log('Links validated:', linksData);
            const hiddenInput = document.getElementById('productLinksData');
            if (hiddenInput) {
                hiddenInput.value = JSON.stringify(linksData);
            }
        });
    });
    
    // Alternative approach: Add a global function to get links data
    window.getProductLinksData = function() {
        const linksManager = @this;
        if (linksManager) {
            try {
                const links = linksManager.get('links') || [];
                const validLinks = links.filter(link => 
                    link.url && link.url.trim() !== '' && 
                    link.caption && link.caption.trim() !== ''
                );
                console.log('Getting product links data:', validLinks);
                return validLinks;
            } catch (error) {
                console.error('Error getting links data:', error);
                return [];
            }
        }
        return [];
    };
    
    // Debug function to check current links data
    window.debugLinksData = function() {
        console.log('=== Debug Links Data ===');
        
        const linksManager = @this;
        if (linksManager) {
            const allLinks = linksManager.get('links') || [];
            console.log('All links:', allLinks);
            
            const validLinks = window.getProductLinksData();
            console.log('Valid links:', validLinks);
            
            const hiddenInput = document.getElementById('productLinksData');
            if (hiddenInput) {
                console.log('Hidden input value:', hiddenInput.value);
                hiddenInput.value = JSON.stringify(validLinks);
                console.log('Hidden input updated with:', hiddenInput.value);
            } else {
                console.log('Hidden input not found!');
            }
            
            alert('تحقق من Console للمزيد من التفاصيل\nعدد الروابط الصحيحة: ' + validLinks.length);
        } else {
            console.log('Livewire component not found');
            alert('لم يتم العثور على مكون Livewire');
        }
        
        console.log('=== End Debug ===');
    };
</script>
