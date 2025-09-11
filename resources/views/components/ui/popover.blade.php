@props([
    'triggerType' => 'hover',
    'position' => 'bottom',
    'offset' => '8',
    'width' => 'auto'
])

@php
$popoverId = 'popover-' . uniqid();
$widthClass = $width === 'auto' ? 'w-auto' : $width;
@endphp

<div class="relative inline-block" x-data="{
    open: false,
    triggerType: '{{ $triggerType }}',
    triggerRect: null,
    hoverTimeout: null,
    toggle() {
        this.updateTriggerRect();
        this.open = !this.open;
    },
    show() {
        if (this.triggerType === 'hover' || this.triggerType === 'both') {
            if (this.hoverTimeout) {
                clearTimeout(this.hoverTimeout);
                this.hoverTimeout = null;
            }
            this.updateTriggerRect();
            this.open = true;
        }
    },
    hide() {
        if (this.triggerType === 'hover' || this.triggerType === 'both') {
            this.hoverTimeout = setTimeout(() => {
                this.open = false;
            }, 150);
        }
    },
    cancelHide() {
        if (this.hoverTimeout) {
            clearTimeout(this.hoverTimeout);
            this.hoverTimeout = null;
        }
    },
    updateTriggerRect() {
        this.triggerRect = this.$refs.trigger.getBoundingClientRect();
    },
    getPopoverStyles() {
        if (!this.triggerRect) return {};
        
        const position = '{{ $position }}';
        const offset = {{ $offset }};
        const viewport = {
            width: window.innerWidth,
            height: window.innerHeight
        };
        
        let styles = {
            position: 'fixed',
            zIndex: 9999
        };
        
        // Estimate popover width for positioning calculations
        const estimatedWidth = 320; // Default width for calculations
        
        switch(position) {
            case 'bottom-left':
                styles.top = this.triggerRect.bottom + offset + 'px';
                // Ensure popover doesn't go off-screen on the right
                if (this.triggerRect.left + estimatedWidth > viewport.width) {
                    styles.right = (viewport.width - this.triggerRect.right) + 'px';
                } else {
                    styles.left = this.triggerRect.left + 'px';
                }
                break;
            case 'bottom-right':
                styles.top = this.triggerRect.bottom + offset + 'px';
                // Ensure popover doesn't go off-screen on the left
                if (this.triggerRect.right - estimatedWidth < 0) {
                    styles.left = this.triggerRect.left + 'px';
                } else {
                    styles.right = (viewport.width - this.triggerRect.right) + 'px';
                }
                break;
            case 'bottom':
                styles.top = this.triggerRect.bottom + offset + 'px';
                const centerLeft = this.triggerRect.left + this.triggerRect.width / 2;
                // Check if centered position would go off-screen
                if (centerLeft - estimatedWidth / 2 < 10) {
                    // Too close to left edge
                    styles.left = '10px';
                } else if (centerLeft + estimatedWidth / 2 > viewport.width - 10) {
                    // Too close to right edge
                    styles.right = '10px';
                } else {
                    // Safe to center
                    styles.left = centerLeft + 'px';
                    styles.transform = 'translateX(-50%)';
                }
                break;
            case 'top':
                styles.bottom = (viewport.height - this.triggerRect.top + offset) + 'px';
                const topCenterLeft = this.triggerRect.left + this.triggerRect.width / 2;
                // Check if centered position would go off-screen
                if (topCenterLeft - estimatedWidth / 2 < 10) {
                    styles.left = '10px';
                } else if (topCenterLeft + estimatedWidth / 2 > viewport.width - 10) {
                    styles.right = '10px';
                } else {
                    styles.left = topCenterLeft + 'px';
                    styles.transform = 'translateX(-50%)';
                }
                break;
            default:
                styles.top = this.triggerRect.bottom + offset + 'px';
                if (this.triggerRect.left + estimatedWidth > viewport.width) {
                    styles.right = (viewport.width - this.triggerRect.right) + 'px';
                } else {
                    styles.left = this.triggerRect.left + 'px';
                }
        }
        
        return styles;
    }
}"
@if($triggerType === 'hover' || $triggerType === 'both')
x-on:mouseenter="show()"
x-on:mouseleave="hide()"
@endif
>
    <!-- Trigger -->
    <div
        x-ref="trigger"
        @if($triggerType === 'click' || $triggerType === 'both')
        x-on:click="toggle()"
        @endif
        class="cursor-pointer">
        {{ $trigger }}
    </div>

    <!-- Teleported Popover Content -->
    <template x-teleport="body">
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             x-cloak
             :style="getPopoverStyles()"
             class="{{ $widthClass }}"
             @click.outside="open = false"
             @mouseenter="cancelHide()"
             @mouseleave="hide()">

            <!-- Content -->
            <div class="bg-white shadow-lg drop-shadow-sm p-4 rounded-xl"
                 style="box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);">
                {{ $slot }}
            </div>
        </div>
    </template>
</div>
