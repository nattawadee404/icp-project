<template>
  <card-component>
    <!-- <template card-top>
      <div class="card-top">
        <img src="http://f.ptcdn.info/148/003/000/1363274726-043-o.jpg"/>
        <i class="fa-solid fa-ellipsis-vertical"></i>
      </div>
    </template> -->
    <template v-slot:card-header>
      <body>
        <div class="card">
          <div class="cart-top">
            <div class="info">
              <img src="http://f.ptcdn.info/148/003/000/1363274726-043-o.jpg" />
              <!-- <i class="fas fa-ellipsis-v"></i> -->
              <div class="name">
                <p>{{ name }}</p>
              </div>
              <h4>{{ plan_career }}</h4>
            </div>
          </div>
          <!-- </template>
           <template v-slot:card-content> -->
          <!-- <transition name="fading">
            <div v-show="isVisible"> -->
          <div class="card-bottom">
            <div class="detail"></div>
            <!-- <p class="menu">about</p> -->
            <p>{{ study_faculty }} {{ university }}</p>
            <div class="social">
              <i class="fa-brands fa-facebook"></i>
              <i class="fa-brands fa-twitter"></i>
              <i class="fa-brands fa-youtube"></i>
              <i class="fa-brands fa-github"></i>
            </div>
          </div>
          <!-- </div>
          </transition> -->
          <!-- </template>
           <template v-slot:card-status> -->
          <div class="card-status">
            <div class="status-form">
              <p>{{ disibility_type }}</p>
            </div>
          </div>
          <!-- </template>
          <template v-slot:card-button> -->
          <div class="btn"></div>
          <button class="btn-hire" @click="showData(id)">ดูรายละเอียด</button>
          &nbsp;
          <button class="btn-dismiss" @click="deleteData(id)">ลบข้อมูล</button>
        </div>
      </body>
    </template>
  </card-component>
</template>

<script>
import CardComponent from "./CardComponent.vue";
export default {
  name: "PersonData",
  data() {
    return {
      message: "Personal Data (แสดงข้อมูลแต่ละบุคคล)",
    };
  },
  props: {
    id: {
      type: Number,
      require: true,
    },
    name: {
      type: String,
      require: true,
      default: "",
    },
    study_faculty: {
      type: String,
      require: true,
      default: "",
    },
    university: {
      type: String,
      require: true,
      default: "",
    },
    disibility_type: {
      type: String,
      require: true,
      default: "",
    },
    plan_career: {
      type: String,
      require: true,
      default: "",
    },
    salary: {
      type: Number,
      require: true,
      default: 0,
    },
    isVisible: {
      type: Boolean,
      require: true,
      default: false,
    },
  },
  methods: {
    showData(id) {
      console.log("show-Person id", id);
      this.$emit("showData", id);
    },
    deleteData(id) {
      console.log("delete-Person id", id);
      this.$emit("deleteData", id);
    },
  },
  components: {
    CardComponent,
  },
};
</script>

<style scoped>
/* button {
  font: inherit;
  cursor: pointer;
  border: 1px solid gray;
  background: gray;
  color: white;
  padding: 0.05rem 1rem;
  box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.26);
} */
body {
  background: linear-gradient(125deg, #3498db, #9b59b6);
  width: 100%;
  height: 100%;
}

.card {
  height: 430px;
  width: 300px;
  background: white;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
}

.card-top {
  height: 330px;
  width: 100%;
}

img {
  margin: 4%; 
  height: 10%;
  width: 50%;
}

/* .cart-top i{
  position: absolute;
  top: 15px;
  right: 15px;
  font-size: 1.5rem;
  color: white;
  cursor: pointer;
} */
.info {
  height: 100%;
  width: 100%;
  background: white;
}
.name {
  font-size: 1rem;
  font-weight: 600;
  margin: 10px 0;
  padding: 10px 0;
  border-bottom: 2px solid white;
  text-shadow: 0 3px 5px rgba(0, 0, 0, 0.5);
}
.info h4 {
  color: #0e0aee;
  text-shadow: 0 3px 5px rgba(0, 0, 0, 0.5);
}
.card-bottom {
  height: 50px;
  width: 100%;
  /* background: blue; */
}
.detail {
  color: red;
} /*
.detail .social {
  margin: 10px 0;
}

.detail .social a{
  margin: 0 3px;
  cursor: pointer;
  color: royalblue;
}
.menu {
  font-size: 1rem;
  font-weight: 700;
  border-bottom: 2px solid black;
  width: 40px;
  padding: 5px 0;
  margin-bottom: 10px;
} */

.fading-enter-from {
  opacity: 0;
}
.fading-enter-active {
  transition: all 1s linear;
}
</style>
