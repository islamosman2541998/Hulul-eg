<form wire:submit.prevent="submit">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-group">
        <label>Full Name *</label>
        <input 
            wire:model.defer="name" 
            type="text" 
            class="form-control @error('name') is-invalid @enderror" 
            placeholder="John Doe"
        >
        @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Email *</label>
        <input 
            wire:model.defer="email" 
            type="email" 
            class="form-control @error('email') is-invalid @enderror" 
            placeholder="you@email.com"
        >
        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Phone *</label>
        <input 
            wire:model.defer="phone" 
            type="tel" 
            class="form-control @error('phone') is-invalid @enderror" 
            placeholder="+20 1X XXX XXXX"
        >
        @error('phone')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Upload Your CV (PDF/Doc) *</label>
        <input 
            wire:model="cv" 
            type="file" 
            class="form-control-file @error('cv') is-invalid @enderror" 
            accept=".pdf,.doc,.docx"
        >
        @error('cv')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
        
        <div wire:loading wire:target="cv" class="text-info small mt-1">
            <i class="fa fa-spinner fa-spin"></i> Uploading...
        </div>
    </div>

    <div class="form-group">
        <label>Message</label>
        <textarea 
            wire:model.defer="message" 
            class="form-control" 
            rows="3"
            placeholder="Tell us about yourself..."
        ></textarea>
    </div>

    <button 
        type="submit" 
        class="btn btn-info btn-block"
        wire:loading.attr="disabled"
    >
        <span wire:loading.remove wire:target="submit">
            <i class="fa fa-paper-plane"></i> Submit Application
        </span>
        <span wire:loading wire:target="submit">
            <i class="fa fa-spinner fa-spin"></i> Submitting...
        </span>
    </button>
</form>