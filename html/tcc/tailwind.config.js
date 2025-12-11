export default {
  content: ["./public/**/*.html"],

  theme: {
    extend: {
      colors: {
        header: "#1E293B",
        logo: "#3B82F6",
        nav: "#F1F5F9",
        hover: "#06B6D4",
        cta: "#F97316",
        search: "#334155",

        tools: "#10B981",
        blog: "#8B5CF6",
        info: "#F59E0B",

        textmain: "#E6EEF8",
        muted: "rgba(241, 245, 249, .85)",
        border: "rgba(255, 255, 255, .06)",

        gradstart: "#071033",
        gradend: "#021025",
        footerdark: "#020617",
      },

      borderRadius: {
        sm: "8px",
        md: "10px",
        lg: "12px",
        xl: "16px",
        pill: "999px"
      },

      fontFamily: {
        sans: [
          "Inter",
          "system-ui",
          "-apple-system",
          "Segoe UI",
          "Roboto",
          "Arial"
        ]
      },

      boxShadow: {
        header: "0 6px 18px rgba(0,0,0,.5)",
        card: "0 25px 50px rgba(0,0,0,.4)"
      },

      backgroundImage: {
        "page-gradient": "linear-gradient(180deg, #071033, #021025)",
        "card-gradient": "linear-gradient(180deg, #0F172A, #020617)",
        "mock-gradient": "linear-gradient(180deg, #071833, #03263f)"
      },

      zIndex: {
        header: "50"
      },

      maxWidth: {
        container: "1100px",
        footer: "1200px"
      }
    }
  }
};
