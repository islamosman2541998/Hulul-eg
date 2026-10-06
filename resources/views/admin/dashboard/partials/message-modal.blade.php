{{--
    Popup showing the full text of a message.
    Any element with class "js-message-preview" opens it, reading:
      data-message : the full text
      data-sender  : who wrote it (optional, shown under the title)
--}}
<div class="msg-modal" id="messageModal" hidden role="dialog" aria-modal="true" aria-labelledby="messageModalTitle">
    <div class="msg-modal__backdrop" data-close></div>

    <div class="msg-modal__card" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="msg-modal__head">
            <div class="msg-modal__heading">
                <span class="msg-modal__icon" aria-hidden="true"><i class="fas fa-comment-dots"></i></span>
                <span class="msg-modal__titles">
                    <strong id="messageModalTitle">@lang('admin.full_message')</strong>
                    <small id="messageModalSender"></small>
                </span>
            </div>

            <button type="button" class="msg-modal__close" data-close aria-label="@lang('admin.close')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="msg-modal__body" id="messageModalBody"></div>

        <div class="msg-modal__foot">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-close>@lang('admin.close')</button>
            <button type="button" class="btn btn-sm btn-primary" id="messageModalCopy" data-copy="@lang('admin.copy')"
                data-copied="@lang('admin.copied')">
                <i class="fas fa-copy"></i> @lang('admin.copy')
            </button>
        </div>
    </div>
</div>

<style>
    .message-cell {
        max-width: 260px;
    }

    .js-message-preview {
        display: block;
        width: 100%;
        padding: 0;
        border: 0;
        background: none;
        color: inherit;
        font: inherit;
        text-align: start;
        cursor: pointer;

        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .js-message-preview:hover,
    .js-message-preview:focus-visible {
        color: #0d6efd;
        text-decoration: underline;
    }

    .msg-modal {
        position: fixed;
        inset: 0;
        z-index: 100000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }

    .msg-modal[hidden] {
        display: none;
    }

    .msg-modal__backdrop {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .msg-modal__card {
        position: relative;
        display: flex;
        flex-direction: column;

        width: 100%;
        max-width: 560px;
        max-height: calc(100vh - 32px);

        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.3);

        opacity: 0;
        transform: translateY(12px) scale(0.97);
        transition: opacity 0.22s ease, transform 0.22s ease;
    }

    .msg-modal.is-open .msg-modal__backdrop,
    .msg-modal.is-open .msg-modal__card {
        opacity: 1;
    }

    .msg-modal.is-open .msg-modal__card {
        transform: none;
    }

    .msg-modal__head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;

        padding: 16px 20px;
        border-bottom: 1px solid #eef0f4;
    }

    .msg-modal__heading {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .msg-modal__icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;

        width: 40px;
        height: 40px;
        border-radius: 12px;

        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        font-size: 17px;
    }

    .msg-modal__titles {
        min-width: 0;
        text-align: start;
    }

    .msg-modal__titles strong {
        display: block;
        color: #101828;
        font-size: 16px;
        line-height: 1.4;
    }

    .msg-modal__titles small {
        display: block;
        color: #667085;
        font-size: 13px;
        line-height: 1.4;
    }

    .msg-modal__close {
        flex-shrink: 0;
        width: 32px;
        height: 32px;
        padding: 0;
        border: 0;
        border-radius: 8px;

        background: #f2f4f7;
        color: #667085;
        font-size: 22px;
        line-height: 1;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .msg-modal__close:hover {
        background: #e4e7ec;
        color: #101828;
    }

    .msg-modal__body {
        flex: 1 1 auto;
        overflow-y: auto;

        padding: 18px 20px;

        color: #344054;
        font-size: 15px;
        line-height: 1.85;
        white-space: pre-wrap;
        overflow-wrap: break-word;
        text-align: start;
    }

    .msg-modal__foot {
        display: flex;
        justify-content: flex-end;
        gap: 8px;

        padding: 14px 20px;
        border-top: 1px solid #eef0f4;
    }

    @media (max-width: 575px) {
        .msg-modal__card {
            max-width: 100%;
            border-radius: 14px;
        }

        .msg-modal__body {
            font-size: 14.5px;
        }

        .msg-modal__foot .btn {
            flex: 1 1 auto;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .msg-modal__card,
        .msg-modal__backdrop {
            transition: none;
        }
    }
</style>

<script>
    (function() {
        const modal = document.getElementById('messageModal');

        if (!modal) {
            return;
        }

        const body = document.getElementById('messageModalBody');
        const sender = document.getElementById('messageModalSender');
        const copyBtn = document.getElementById('messageModalCopy');
        let lastFocus = null;

        const resetCopyLabel = function() {
            copyBtn.innerHTML = '<i class="fas fa-copy"></i> ' + copyBtn.dataset.copy;
        };

        const open = function(trigger) {
            body.textContent = trigger.dataset.message || '';
            sender.textContent = trigger.dataset.sender || '';
            resetCopyLabel();

            lastFocus = trigger;
            modal.hidden = false;
            requestAnimationFrame(() => requestAnimationFrame(() => modal.classList.add('is-open')));
            modal.querySelector('.msg-modal__close').focus({
                preventScroll: true
            });
        };

        const close = function() {
            if (modal.hidden) {
                return;
            }

            modal.classList.remove('is-open');
            setTimeout(() => {
                modal.hidden = true;
            }, 220);

            if (lastFocus && document.body.contains(lastFocus)) {
                lastFocus.focus({
                    preventScroll: true
                });
            }
        };

        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('.js-message-preview');

            if (trigger) {
                e.preventDefault();
                open(trigger);
                return;
            }

            if (e.target.closest('[data-close]')) {
                close();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                close();
            }
        });

        copyBtn.addEventListener('click', function() {
            const done = function() {
                copyBtn.innerHTML = '<i class="fas fa-check"></i> ' + copyBtn.dataset.copied;
                setTimeout(resetCopyLabel, 1800);
            };

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(body.textContent).then(done).catch(function() {});
                return;
            }

            // plain http pages have no clipboard API: fall back to a hidden textarea
            const area = document.createElement('textarea');
            area.value = body.textContent;
            area.style.position = 'fixed';
            area.style.opacity = '0';
            document.body.appendChild(area);
            area.select();

            try {
                document.execCommand('copy');
                done();
            } catch (err) {
                // nothing else to try
            }

            area.remove();
        });
    })();
</script>
