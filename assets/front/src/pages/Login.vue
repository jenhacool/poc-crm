<template>
  <div id="poc-crm-login-page">
    <a-layout>
      <a-layout-content>
        <login-form />
      </a-layout-content>
    </a-layout>
  </div>
</template>

<script>
import LoginForm from '../components/LoginForm';

export default {
  components: {
    LoginForm
  }
}
</script>

<style lang="scss">
#poc-crm-login-page {
  main {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
}
</style>