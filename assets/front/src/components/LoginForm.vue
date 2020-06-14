<template>
  <div id="poc-crm-login-form">
    <a-form
      :form="form"
      @submit.prevent="onSubmit"
    >
      <a-form-item>
        <a-input
          v-decorator="fields.email.decorator"
          placeholder="Email"
        >
          <a-icon
            slot="prefix"
            type="mail"
            class="login-form-icon"
          />
        </a-input>
      </a-form-item>
      <a-form-item>
        <a-input
          v-decorator="fields.password.decorator"
          type="password"
          placeholder="Password"
        >
          <a-icon
            slot="prefix"
            type="lock"
            class="login-form-icon"
          />
        </a-input>
      </a-form-item>
      <a-form-item v-if="loginFailed">
        <a-alert
          :message="loginFailMessage"
          type="error"
        />
      </a-form-item>
      <a-form-item>
        <a-button
          :disabled="isSubmitting"
          type="primary"
          html-type="submit"
          class="login-form-button"
        >
          Log in
        </a-button>
      </a-form-item>
    </a-form>
  </div>
</template>

<script>
import { mapGetters, mapState } from 'vuex'

export default {
  data() {
    return {
      fields: {
        email: {
          decorator: [
            'email',
            {
              rules: [
                {
                  required: true, 
                  message: 'Please input your email!' 
                }, 
                { 
                  type: 'email', 
                  message: 'Please input correct email!' 
                }
              ]
            }
          ]
        },
        password: {
          decorator: [
            'password',
            { 
              rules: [
                { 
                  required: true,
                  message: 'Please input your Password!'
                }
              ] 
            }
          ]
        }
      }
    }
  },
  computed: {
    ...mapState({
      isSubmitting: 'submitting'
    }),
    ...mapGetters('auth', {
      loginFailed: 'loginFailed',
      loginFailMessage: 'loginFailMessage'
    })
  },
  created() {
    this.form = this.$form.createForm(this, {name: 'login'});
  },
  methods: {
    onSubmit() {
      this.form.validateFieldsAndScroll((err, values) => {
        if(err) {
          return;
        }
        this.$store.dispatch('auth/login', values);
      });
    }
  }
}
</script>

<style lang="scss">
#poc-crm-login-form {
  width: 400px;
  padding: 20px;
  background: #fff;
  border-radius: 2px;

  form {
    .ant-form-item {
      margin-bottom: 10px;

      &:last-child {
        margin-bottom: 0;
      }
    }

    .login-form-icon {
      color: rgba(0,0,0,.25)
    }

    .login-form-button {
      width: 100%;
      box-shadow: none;
    }
  }
}
</style>