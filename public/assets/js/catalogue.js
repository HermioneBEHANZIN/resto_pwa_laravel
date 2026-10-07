const CATALOGUE = {
  "magret-canard": {
    name:'Magret de Canard', price:16000,
    desc:'Magret de canard rôti, sauce aux figues et miel, purée de patates douces, légumes de saison.',
    img:'https://images.unsplash.com/photo-1544025162-d76694265947?w=800&q=80',
    rating:4.9, reviews:41,
    ingredients:[
      {name:'Canard', icon:'fa-drumstick-bite'},
      {name:'Figues', icon:'fa-leaf'},
      {name:'Miel', icon:'fa-jar'},
      {name:'Patate douce', icon:'fa-carrot'},
      {name:'Légumes', icon:'fa-seedling'}
    ],
    allergens:[
      {name:'Gluten', icon:'fa-wheat-awn'},
      {name:'Lait', icon:'fa-cheese'},
      {name:'Épicé', icon:'fa-pepper-hot'},
      {name:'Sulfites', icon:'fa-flask'},
      {name:'Fruits à coque', icon:'fa-tree'}
    ],
    suggestions:['tilapia','poulet-braise','pizza-prestige']
  },
  "burger-royal": {
    name:'Burger Royal', price:4500,
    desc:'Steak de bœuf, cheddar, salade, tomates, sauce spéciale, pain brioché toasté.',
    img:'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=800&q=80',
    rating:4.9, reviews:128,
    ingredients:[
      {name:'Bœuf', icon:'fa-drumstick-bite'},
      {name:'Cheddar', icon:'fa-cheese'},
      {name:'Salade', icon:'fa-leaf'},
      {name:'Tomate', icon:'fa-apple-whole'},
      {name:'Pain', icon:'fa-bread-slice'}
    ],
    allergens:[
      {name:'Gluten', icon:'fa-wheat-awn'},
      {name:'Lait', icon:'fa-cheese'},
      {name:'Œufs', icon:'fa-egg'},
      {name:'Sésame', icon:'fa-seedling'}
    ],
    suggestions:['pizza-prestige','poulet-braise','fondant-chocolat']
  },
  "pizza-prestige": {
    name:'Pizza Gourmet', price:6000,
    desc:'Poulet grillé, champignons, poivrons, mozzarella, sauce maison sur pâte fine.',
    img:'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800&q=80',
    rating:4.8, reviews:96,
    ingredients:[
      {name:'Poulet', icon:'fa-drumstick-bite'},
      {name:'Mozzarella', icon:'fa-cheese'},
      {name:'Poivron', icon:'fa-pepper-hot'},
      {name:'Champignon', icon:'fa-seedling'}
    ],
    allergens:[
      {name:'Gluten', icon:'fa-wheat-awn'},
      {name:'Lait', icon:'fa-cheese'}
    ],
    suggestions:['burger-royal','magret-canard','fondant-chocolat']
  },
  "poulet-braise": {
    name:'Poulet Braisé', price:4000,
    desc:'Poulet mariné aux épices africaines, alloco, sauce champion.',
    img:'https://images.unsplash.com/photo-1598103442097-8b74394b95c8?w=800&q=80',
    rating:4.8, reviews:87,
    ingredients:[
      {name:'Poulet', icon:'fa-drumstick-bite'},
      {name:'Épices', icon:'fa-pepper-hot'},
      {name:'Alloco', icon:'fa-carrot'}
    ],
    allergens:[
      {name:'Épicé', icon:'fa-pepper-hot'}
    ],
    suggestions:['magret-canard','tilapia','bissap']
  },
  "fondant-chocolat": {
    name:'Fondant au Chocolat', price:2500,
    desc:'Cœur coulant, glace vanille, sauce chocolat.',
    img:'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=800&q=80',
    rating:4.9, reviews:74,
    ingredients:[
      {name:'Chocolat', icon:'fa-cookie-bite'},
      {name:'Œuf', icon:'fa-egg'},
      {name:'Crème', icon:'fa-cheese'}
    ],
    allergens:[
      {name:'Gluten', icon:'fa-wheat-awn'},
      {name:'Lait', icon:'fa-cheese'},
      {name:'Œuf', icon:'fa-egg'}
    ],
    suggestions:['burger-royal','pizza-prestige','bissap']
  },
  "tilapia": {
    name:'Tilapia Grillé', price:5500,
    desc:'Tilapia grillé aux épices, riz, sauce tomate maison.',
    img:'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=800&q=80',
    rating:4.7, reviews:53,
    ingredients:[
      {name:'Tilapia', icon:'fa-fish'},
      {name:'Riz', icon:'fa-bowl-rice'},
      {name:'Épices', icon:'fa-pepper-hot'}
    ],
    allergens:[
      {name:'Poisson', icon:'fa-fish'}
    ],
    suggestions:['poulet-braise','alloco','bissap']
  },
  "bissap": {
    name:'Jus de Bissap', price:1000,
    desc:"Boisson rafraîchissante à base de fleurs d'hibiscus, gingembre et menthe.",
    img:'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=800&q=80',
    rating:4.6, reviews:38,
    ingredients:[
      {name:'Hibiscus', icon:'fa-seedling'},
      {name:'Gingembre', icon:'fa-carrot'},
      {name:'Menthe', icon:'fa-leaf'}
    ],
    allergens:[],
    suggestions:['alloco','tilapia','fondant-chocolat']
  },
  "alloco": {
    name:'Alloco Spécial', price:1500,
    desc:'Bananes plantain frites, sauce pimentée maison, oignons.',
    img:'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=800&q=80',
    rating:4.7, reviews:29,
    ingredients:[
      {name:'Plantain', icon:'fa-carrot'},
      {name:'Sauce piment', icon:'fa-pepper-hot'}
    ],
    allergens:[
      {name:'Épicé', icon:'fa-pepper-hot'}
    ],
    suggestions:['poulet-braise','bissap','tilapia']
  }
};