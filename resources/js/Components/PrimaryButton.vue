<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button :type="type"
        class="bg-[#0095F6] text-white font-extrabold text-lg rounded-lg hover:bg-[#2150FA] w-full p-1.5"
    >
        <slot />
    </button>
</template>
