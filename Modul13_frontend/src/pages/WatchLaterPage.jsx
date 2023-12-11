import {
  Container,
  Stack,
  Spinner,
  Alert,
  Col,
  Row,
} from "react-bootstrap";

import { useEffect, useState } from "react";

import { getThumbnail } from "../api";

import { GetMyWatchLater } from "../api/apiWatchLater";

const WatchLaterPage = () => {
  const [watchLater, setWatchLater] = useState([]);

  const [isLoading, setIsLoading] = useState(false);

  const fetchWatchLater = (filter) => {
    setIsLoading(true);
    GetMyWatchLater(filter)
      .then((data) => {
        setWatchLater(data);
        console.log(data);
        setIsLoading(false);
      })
      .catch((err) => {
        console.log(err);
      });
  };
  useEffect(() => {
    fetchWatchLater();
  }, []);

  return (
    <Container className="mt-4">
      <Stack direction="horizontal" gap={3} className="mb-3">
        <h1 className="h4 fw-bold mb-0 text-nowrap">My Watch Later List</h1>
        <hr className="border-top border-light opacity-50 w-100" />
      </Stack>
      {isLoading ? (
        <div className="text-center">
          <Spinner
            as="span"  
            animation="border"
            variant="primary"
            size="lg"
            role="status"
            aria-hidden="true"
          />
          <h6 className="mt-2 mb-0">Loading...</h6>
        </div>
      ) : watchLater?.length > 0 ? (
        <Row>
          {watchLater?.map((data) => (
            <Col md={6} lg={4} className="mb-3" key={data.id}>
              <div
                className="card text-white"
                style={{ aspectRatio: "2/1" }}
              >

                <img
                  src={getThumbnail(data.content.thumbnail)}
                  className="card-img w-100 h-100 object-fit-cover bg-light"
                  alt="..."
                />

                <div className="card-body">
                  <h5 className="card-title text-truncate">
                    {data.content.title}
                  </h5>
                  <div className="d-flex justify-content-between">
                    <p className="card-text">{data.content.description}</p>
                  </div>
                </div>
              </div>
            </Col>
          ))}
        </Row>
      ) : (
        <Alert variant="dark" className="text-center">
          Kamu Masih Belum Memiliki Video Yang Di Favoritkan !
        </Alert>
      )}
    </Container>
  );
};

export default WatchLaterPage;
