<script lang="ts" setup>
  import type { ICategory } from '@/scripts/utils/types';
  import { useForm } from '@inertiajs/inertia-vue3';

  defineProps<{
    categories: ICategory[];
  }>();

  const form = useForm<{
    name: string;
    category?: string | null;
  }>({
    name: '',
    category: null,
  });

  const submit = () => {
    form.post(`/todos`, {
      preserveScroll: true,
    });
    form.reset();
  };
</script>

<template>
  <form @submit.prevent="submit" class="space-y-2">
    <div>
      <label for="todo" class="block mb-1">Add TODO</label>
      <input
        type="text"
        id="todo"
        v-model="form.name"
        class="block w-full border-none rounded-md shadow-inner bg-gray-lighter"
      />
    </div>
    <div class="md:flex md:justify-between md:items-end md:space-x-4">
      <div v-if="categories.length" class="mb-4 grow shrink md:mb-0">
        <label for="category" class="block mb-1">Category</label>
        <select
          id="category"
          v-model="form.category"
          class="block w-full border-none rounded-md shadow-inner bg-gray-lighter"
        >
          <option :value="null">Choose Category</option>
          <option v-for="category in categories" :key="category.uuid" :value="category.uuid">
            {{ category.name }}
          </option>
        </select>
      </div>
      <button
        type="submit"
        class="px-8 py-2 font-medium text-white rounded-md bg-gray-darker shrink-0 disabled:cursor-not-allowed"
        :disabled="!form.isDirty || form.name === ''"
      >
        Add TODO
      </button>
    </div>
  </form>
</template>
