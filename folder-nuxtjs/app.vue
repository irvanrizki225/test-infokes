<script setup lang="ts">
import { ref, onMounted } from 'vue';
import Content from './components/content.vue';


// Reactive reference for the address bar value
const addressBarValue = ref('This PC');

// List of sidebar links (assuming you have this list dynamically)
const sidebarLinks = ref([]);

// Fetch runtime config (public API base)
const config = useRuntimeConfig();

// Function to fetch data from the API
const fetchSidebarLinks = async () => {
  try {
    // Fetch data from API using the runtime config's public API base URL
    const response = await $fetch(`${config.public.apiBase}/folders`);
    // console.log(response.data)
    const folders = response?.data || [];

    // Populate sidebarLinks with fetched data
    sidebarLinks.value = folders.map((item: any) => ({
      name: item.name,
      isActive: false,
    }));
  } catch (error) {
    console.error('Error fetching sidebar links:', error);
    // Handle error (e.g., show a message to the user)
  }
};

// Function to handle the click event on sidebar items
const handleSidebarClick = (link: any) => {
  // Deactivate all links
  sidebarLinks.value.forEach(l => l.isActive = false);
  
  // Activate the clicked link
  link.isActive = true;
  
  // Update the address bar value
  addressBarValue.value = link.name;
};

// Trigger data fetch on component mount
onMounted(() => {
  fetchSidebarLinks();
});
</script>

<template>
  <div class="container-fluid vh-100 d-flex flex-column">
    <!-- Address bar -->
    <div class="row mb-3">
      <div class="col-3">
        <div class="row align-items-start">
          <div class="col-3">
            <a href="#" class="">
              <i class="fa fa-plus-circle"></i>
              New
            </a>
          </div>
          <div class="col-3">
            <a href="#" class="">
              <i class="fa fa-trash"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="col-9">
        <input 
          type="text" 
          class="form-control" 
          id="address-bar" 
          v-model="addressBarValue"
          disabled
        >
      </div>
    </div>
    <div class="row flex-grow-1">
      <!-- Sidebar -->
      <div class="col-3 border-end h-100" id="sidebar">
        <ul class="list-group border-0">
          <li 
            v-for="link in sidebarLinks" 
            :key="link.name" 
            class="list-group-item" 
            :class="{ active: link.isActive }" 
            @click="handleSidebarClick(link)"
          >
            <img src="/public/assets/folder.svg" alt="Folder" class="img-fluid me-2" style="width: 20px; height: 20px;">
            {{ link.name }}
          </li>
        </ul>
      </div>
      <!-- Content -->
      <Content :data="addressBarValue" />
    </div>
  </div>
</template>

<style scoped>
#sidebar .list-group-item {
  border: none;
}

#sidebar {
  border-right: 1px solid #ddd;
}

.icon-box {
  margin-bottom: 20px;
}

.icon-box img {
  width: 80px;
  height: 80px;
}

.icon-box p {
  margin-top: 10px;
  font-size: 14px;
}

.icon-box:hover {
  background-color: #f5f5f5;
  cursor: pointer;
}

.active {
  color: black;
  background-color: #f5f5f5;
}
</style>
