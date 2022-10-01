<script lang="ts" setup>
  import { useForm } from '@inertiajs/inertia-vue3';

  const form = useForm<{
    name: string;
  }>({
    name: '',
  });

  const submit = () => {
    form.post(`/categories`, {
      preserveScroll: true
    })
    form.reset();
  }
</script>

<template>
  <form @submit.prevent="submit" class="space-y-2">
    <div class="md:flex md:justify-between md:items-end md:space-x-4">
      <div class="mb-4 grow shrink md:mb-0">
        <label for="add_category" class="block mb-1">Add Category</label>
        <input type="text" id="add_category" v-model="form.name" class="block w-full border-none rounded-md shadow-inner bg-gray-lighter" />
      </div>
      <button type="submit" class="px-8 py-2 font-medium text-white rounded-md bg-gray-darker shrink-0 disabled:cursor-not-allowed" :disabled="!form.isDirty">Add Category</button>
    </div>
  </form>
</template>

