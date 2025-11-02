@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $showPopup    = (int) $settings->getCoupon('coupon_show_popup');
    $welcomePromo = null;

    if ($showPopup && $settings->getCoupon('welcome_coupon_id')) {
        $welcomePromo = \App\Models\PromoCode::findOrFail($settings->getCoupon('welcome_coupon_id'));
    }
@endphp

@if($showPopup && $welcomePromo)
    <div class="modal fade" id="autoShowModal" tabindex="-1" aria-labelledby="autoShowModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white">
          <div class="modal-header">
            <h5 class="modal-title main-color" id="autoShowModalLabel">
              {{ __('messages.get_special_discount') }}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('messages.close') }}"></button>
          </div>
          <div class="modal-body text-center">
            <p class="main-color">{{ $settings->getItem('coupon_title') }}</p>
            <h3 class="fw-bold main-color">
              {{ $welcomePromo->code }}
              <button
                class="copy-coupon-btn btn btn-sm btn-outline-primary coupon-btn border-0 main-color-bg text-white ms-2"
                data-code="{{ $welcomePromo->code }}"
              >
                {{ __('messages.copy_coupon') }}
              </button>
            </h3>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary main-color-bg" data-bs-dismiss="modal">
              {{ __('messages.close') }}
            </button>
          </div>
        </div>
      </div>
    </div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modalKey = 'hasSeenAutoModal';
  const autoEl   = document.getElementById('autoShowModal');

  if (!localStorage.getItem(modalKey) && autoEl && typeof bootstrap !== 'undefined') {
    const modal = new bootstrap.Modal(autoEl, { backdrop: 'static', keyboard: false });
    modal.show();

    autoEl.addEventListener('hidden.bs.modal', () => {
      localStorage.setItem(modalKey, 'true');
      document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
      document.body.classList.remove('modal-open');
      document.body.style.removeProperty('overflow');
      document.body.style.removeProperty('padding-right');
      modal.dispose();
    });
  }

  document.querySelectorAll('.copy-coupon-btn').forEach(btn => {
    const code = btn.dataset.code || '';
    const done = () => btn.textContent = "{{ __('messages.coupon_copied') }}";
    const fallback = txt => {
      const ta = document.createElement('textarea');
      ta.value = txt;
      document.body.appendChild(ta);
      ta.select();
      document.execCommand('copy');
      done();
      document.body.removeChild(ta);
    };

    btn.addEventListener('click', e => {
      e.preventDefault();
      if (navigator.clipboard?.writeText) {
        navigator.clipboard.writeText(code).then(done).catch(() => fallback(code));
      } else {
        fallback(code);
      }
    });
  });
});
</script>
@endpush
