<template>
  <div class="mt-10">   

    <div class="max-w-screen-md w-3/4 md:w-3/4 mt-14 mx-auto">
      <div
        class="inline-flex flex-col space-y-2 items-center h-full
           w-full  p-4 bg-blue-400 rounded-xl text-white">
        <p class="w-full text-2xl font-semibold"
          v-for="word in words"
          :key="word.id"
        >
          {{ word.word }}
        </p>
      </div>
      <div class="flex items-center flex-col justify-center mt-8">
        <div class="border rounded-lg border-blue-400 px-4">
          <button @click="loadJapaneseWord">
            <p class="text-sm font-medium leading-normal text-center py-2">
              ガチャガチャする             
            </p>
          </button>
        </div>
          <div class="border rounded-lg border-blue-400 px-4 mt-10">
          <button >
            <a  :href="'https://twitter.com/intent/tweet?text=【次の3つで文章を作ってね】%0A'+ Tweetword1 + '/' + Tweetword2 + '/'+ Tweetword3 +'%0A%0A&hashtags=ガチャガチャ日本語'" id="tw" onClick="window.open(encodeURI(decodeURI(this.href)), 'tweetwindow', 'width=650, height=470, personalbar=0, toolbar=0, scrollbars=1, sizable=1'); return false;" rel="nofollow" class="twitter-link"> 
            <p class="text-sm font-medium leading-normal text-center py-2">
              Tweetする
            </p>
            </a>
          </button>
        </div>
      </div>
 <!-- Form -->
<JPCreateForm/>
 <!-- Form -->
 <!--Posts  -->    
  <div class="flex items-center justify-center mt-2 mb-2">  
 <p class="text-xl ">Posts from Everyone</p>
  </div>
 <div class="mt-4 inline-flex flex-col space-y-2 items-center h-64 w-full  p-4 rounded-xl overflow-y-auto whitespace-normal" >
      <div class="w-full py-4 ">
     <transition-group name="fade" tag="ul" class="list-group">
        <p
          class="w-full text-sm font-semibold border-b-2 "
          v-for="post in posts"
          :key="post.id" >
          {{ post.post }}
        <span class="ml-2" v-if="post.selected_words">[ {{ post.selected_words }} ] </span> 
        </p>
    </transition-group>
      </div>
</div>
  <!--Posts  -->
    </div>
  </div>
</template>

<script>
require('vue2-animate/dist/vue2-animate.min.css')
 import {mapState} from 'vuex'
 import JPCreateForm from '../components/JPCreateForm'
export default {
  data: function () {
    return {
      post:{
        post:'' ,
      },
      word1:'',
      word2:'',
      word3:''
    };
  },
  components: {
JPCreateForm
  },
  created() {
    //actionsをdispatch
    this.$store.dispatch('loadJapaneseWord')
    this.$store.dispatch('loadJapaneseWordPost')
    
  },
  computed: {
...mapState(['words','posts']),
Tweetword1() {
  let word = this.$store.state.words[0]?.word || ''
  return this.word1 = word
},
Tweetword2() {
  let word = this.$store.state.words[1]?.word || ''
  return this.word2 = word
},
Tweetword3() {
  let word = this.$store.state.words[2]?.word || ''
  return this.word3 = word
},

  },
  methods: {
 
    loadJapaneseWord() {
        this.$store.dispatch('loadJapaneseWord')
    },
    deletePost(post) {
        this.$store.dispatch('deleteJapaneseWordPost',post)
    }
  },
};
</script>