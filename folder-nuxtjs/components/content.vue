<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
  data: { type: String, required: false },
});

const sidebarLinks = ref([]);
const config = useRuntimeConfig(); 

const fetchSidebarLinks = async () => {
  try {
    let folders = [];

    if (props.data === 'This PC') {
      const response = await $fetch(`${config.public.apiBase}/histories`);
      folders = response?.data || []; 
    } else {
      const response = await $fetch(`${config.public.apiBase}/folders/${props.data}`);
      folders = response?.data || [];
    }

    sidebarLinks.value = folders.map((item) => ({
      name: item.name,
      isActive: false,
    }));

    console.log(sidebarLinks.value);
  } catch (error) {
    console.error('Error fetching sidebar links:', error);
  }
};

onMounted(() => {
  fetchSidebarLinks();
});

watch(() => props.data, (newValue, oldValue) => {
  if (newValue !== oldValue) {
    fetchSidebarLinks(); // Refetch data when props.data changes
  }
});

</script>

<template>
  <div class="col-9 h-100">
    <!-- Main content area -->
    <div class="row align-items-start" id="content-area">
      <!-- Folder and file icons -->
      <div class="col-2" v-for="link in sidebarLinks" :key="link.name">
        <div class="icon-box text-center">
          <img src="/public/assets/folder.svg" alt="Folder" class="img-fluid" style="width: 80px; height: 80px;" /> 
          <p>{{ link.name }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
