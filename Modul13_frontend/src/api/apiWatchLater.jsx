import useAxios from ".";

export const GetMyWatchLater = async () => {
  const id = JSON.parse(sessionStorage.getItem("user")).id;
  try {
    const response = await useAxios.get(`/watch_laters/user/${id}`, {
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${sessionStorage.getItem("token")}`,
      },
    });
    return response.data.data;
  } catch (error) {
    throw error.response.data;
  }
};

